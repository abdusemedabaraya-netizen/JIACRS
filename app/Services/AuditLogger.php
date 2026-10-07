<?php

namespace App\Services;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AuditLogger
{
    /** Staff / logged-in action: stores the user id and IP address. */
    public static function log(string $action, ?Model $subject = null, ?string $description = null): void
    {
        self::record($action, auth()->id(), $subject, $description, true);
    }

    /** Anything tied to an anonymous reporter: NO user id, NO IP address. */
    public static function logAnonymous(string $action, ?Model $subject = null, ?string $description = null): void
    {
        self::record($action, null, $subject, $description, false);
    }

    public static function record(string $action, ?int $userId, ?Model $subject, ?string $description, bool $withIp): void
    {
        try {
            AuditLog::create([
                'user_id'      => $userId,
                'action'       => $action,
                'subject_type' => $subject?->getMorphClass(),
                'subject_id'   => $subject?->getKey(),
                'description'  => $description ? Str::limit($description, 1000, '') : null,
                'ip_address'   => $withIp ? request()->ip() : null,
            ]);
        } catch (\Throwable $e) {
            report($e); // an audit failure must never break the user's request
        }
    }
}
