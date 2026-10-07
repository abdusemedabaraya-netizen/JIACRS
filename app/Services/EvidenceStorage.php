<?php

namespace App\Services;

use App\Models\Evidence;
use App\Models\Report;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class EvidenceStorage
{
    private const EXT = [
        'image/jpeg'      => 'jpg',
        'image/png'       => 'png',
        'application/pdf' => 'pdf',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
        'video/mp4'       => 'mp4',
    ];

    public function store(Report $report, UploadedFile $file, ?int $uploadedBy, int $sequence): Evidence
    {
        $mime = $file->getMimeType();   // detected from file CONTENT, not the file name
        $ext  = self::EXT[$mime] ?? null;

        if (! $ext) {
            throw ValidationException::withMessages(['files' => 'Unsupported file type.']);
        }

        $disk     = Storage::disk(config('jiacrs.evidence_disk'));
        $dir      = "evidence/{$report->id}";
        $stored   = Str::random(40) . '.' . $ext;     // random name: nothing guessable
        $path     = "{$dir}/{$stored}";
        $stripped = false;

        if (in_array($mime, ['image/jpeg', 'image/png'], true)) {
            // Re-encoding the pixels drops EXIF (GPS, camera, date) and other metadata.
            $contents = $this->reencodeImage($file->getRealPath(), $mime);
            $disk->put($path, $contents);
            $hash     = hash('sha256', $contents);
            $size     = strlen($contents);
            $stripped = true;
        } else {
            $disk->putFileAs($dir, $file, $stored);
            $hash = hash_file('sha256', $file->getRealPath());
            $size = $file->getSize();
        }

        // File names can identify people, so anonymous reports get a neutral name.
        $original = $report->anonymous
            ? "evidence-{$sequence}.{$ext}"
            : $this->cleanName($file->getClientOriginalName(), $ext);

        return Evidence::create([
            'report_id'         => $report->id,
            'uploaded_by'       => $uploadedBy,
            'original_name'     => $original,
            'stored_path'       => $path,
            'mime_type'         => $mime,
            'size'              => $size,
            'sha256'            => $hash,
            'metadata_stripped' => $stripped,
        ]);
    }

    private function reencodeImage(string $path, string $mime): string
    {
        if (! extension_loaded('gd')) {
            throw ValidationException::withMessages([
                'files' => 'Image processing is unavailable on the server (enable the PHP GD extension).',
            ]);
        }

        $img = $mime === 'image/png' ? @imagecreatefrompng($path) : @imagecreatefromjpeg($path);

        if (! $img) {
            throw ValidationException::withMessages(['files' => 'An image could not be processed.']);
        }

        // Keep the picture upright before the orientation tag is lost.
        if ($mime === 'image/jpeg' && function_exists('exif_read_data')) {
            $orientation = @exif_read_data($path)['Orientation'] ?? 1;
            $angle = [3 => 180, 6 => -90, 8 => 90][$orientation] ?? 0;
            if ($angle) {
                $img = imagerotate($img, $angle, 0) ?: $img;
            }
        }

        ob_start();
        if ($mime === 'image/png') {
            imagesavealpha($img, true);
            imagepng($img);
        } else {
            imagejpeg($img, null, 90);
        }
        $data = ob_get_clean();
        imagedestroy($img);

        return $data;
    }

    private function cleanName(string $name, string $ext): string
    {
        $base = pathinfo($name, PATHINFO_FILENAME);
        $base = preg_replace('/[^\p{L}\p{N}_\- ]+/u', '', $base);
        $base = Str::limit(trim($base), 80, '');

        return ($base !== '' ? $base : 'evidence') . '.' . $ext;
    }
}
