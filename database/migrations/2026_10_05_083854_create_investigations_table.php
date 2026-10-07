<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('investigations', function (Blueprint $table) {
<<<<<<< HEAD
            $table->id();
            $table->foreignId('report_id')->unique()->constrained()->cascadeOnDelete();
            $table->foreignId('investigator_id')->constrained('users')->restrictOnDelete();
            $table->longText('findings')->nullable();
            $table->longText('recommendations')->nullable();
=======

            $table->id();

            $table->foreignId('report_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('investigator_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->longText('findings')->nullable();

            $table->longText('recommendation')->nullable();

            $table->date('investigation_date')->nullable();

            $table->enum('status',[
                'pending',
                'ongoing',
                'completed'
            ])->default('pending');

>>>>>>> be38a6dd75183943501997739ad1d99c484cc4e9
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('investigations');
    }
<<<<<<< HEAD
};
=======
};
>>>>>>> be38a6dd75183943501997739ad1d99c484cc4e9
