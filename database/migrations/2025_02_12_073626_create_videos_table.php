<?php

use App\Models\Chapter;
use App\Models\Course;
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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Chapter::class)->constrained()->nullable()->cascadeOnDelete();
            $table->foreignIdFor(Course::class)->constrained()->nullable()->cascadeOnDelete();
            $table->string('name');
            $table->string('image');
            $table->string('description');
            $table->string('video');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
