<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('comments');
            $table->timestamp('date')->useCurrent();
            $table->foreignId('achievement_id')->constrained('achievements');
            $table->foreignId('student_id')->constrained('students');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};