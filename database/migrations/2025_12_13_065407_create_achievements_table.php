<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            $table->enum('category', ['1', '2'])->comment('1 = Akademik, 2 = Non-Akademik');
            $table->enum('grade', ['Lokal', 'Nasional', 'Internasional']);
            $table->date('date');
            $table->string('proof', 255)->nullable();
            $table->string('photo', 255)->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['Draft', 'Verified', 'Publish'])->default('Draft');
            $table->foreignId('student_id')->constrained('students');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('achievements');
    }
};
