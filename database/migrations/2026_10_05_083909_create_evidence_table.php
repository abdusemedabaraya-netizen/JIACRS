<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
<<<<<<< HEAD
        Schema::create('evidence', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_id')->constrained()->cascadeOnDelete();
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('original_name');
            $table->string('stored_path');           // random name on the PRIVATE disk
            $table->string('mime_type', 100);
            $table->unsignedBigInteger('size');
            $table->string('sha256', 64);            // integrity fingerprint
            $table->boolean('metadata_stripped')->default(false);
=======
        Schema::create('evidences', function (Blueprint $table) {

            $table->id();

            $table->foreignId('report_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('file_name');

            $table->string('file_path');

            $table->string('file_type');

            $table->unsignedBigInteger('file_size');

>>>>>>> be38a6dd75183943501997739ad1d99c484cc4e9
            $table->timestamps();
        });
    }

    public function down(): void
    {
<<<<<<< HEAD
        Schema::dropIfExists('evidence');
    }
};
=======
        Schema::dropIfExists('evidences');
    }
};
>>>>>>> be38a6dd75183943501997739ad1d99c484cc4e9
