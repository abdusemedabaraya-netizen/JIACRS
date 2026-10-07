<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_logs', function (Blueprint $table) {
<<<<<<< HEAD
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('action', 100)->index();
            $table->string('subject_type')->nullable();
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->text('description')->nullable();
            $table->string('ip_address', 45)->nullable(); // NULL for anything tied to anonymous reports
            $table->timestamp('created_at')->useCurrent();

            $table->index(['subject_type', 'subject_id']);
=======

            $table->id();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('action');

            $table->text('description');

            $table->string('ip_address')->nullable();

            $table->timestamps();
>>>>>>> be38a6dd75183943501997739ad1d99c484cc4e9
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
<<<<<<< HEAD
};
=======
};
>>>>>>> be38a6dd75183943501997739ad1d99c484cc4e9
