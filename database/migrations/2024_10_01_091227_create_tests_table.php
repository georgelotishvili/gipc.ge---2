<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->timestamp('started_at')->nullable();
            $table->timestamp('finished_at')->nullable();

            $table->boolean('active')->default(true);

            $table->integer('duration')->default(240)->comment('Test duration in minutes');

            $table->integer('questions_count')->default(0)->comment('Number of questions in the test');
            $table->integer('correct_answers_count')->default(0)->comment('Number of correct answers in the test');
            $table->integer('incorrect_answers_count')->default(0)->comment('Number of incorrect answers in the test');
            $table->integer('score')->default(0)->comment('Test score');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};
