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
        Schema::create('plan_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_id')->nullable()->constrained()->cascadeOnDelete();
            $table->text('option_description')->nullable();
            $table->boolean('is_included')->default(false);
            $table->boolean('is_active')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_options');
    }
};
