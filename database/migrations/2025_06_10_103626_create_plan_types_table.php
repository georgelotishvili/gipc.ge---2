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
        Schema::create('plan_types', function (Blueprint $table) {
            $table->id();
            $table->string('type_name')->unique();
            $table->integer('type_duration')->default(30);
            $table->integer('payment_days')->default(3);
            $table->boolean('is_free')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_types');
    }
};
