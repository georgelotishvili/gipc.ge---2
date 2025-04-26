<?php

use App\Enums\WorkTimeType;
use App\Models\User;
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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('position');
            $table->string('city')->nullable();
            $table->enum('worktime', array_column(WorkTimeType::cases(), 'value'))->default(WorkTimeType::FULL_TIME->value);
            $table->decimal('salary', 10, 2)->nullable();
            $table->longText('description');
            $table->string('skills');
            $table->string('email');
            $table->string('phone', 20)->nullable();
            $table->string('website')->nullable();
            $table->string('social')->nullable()->comment('Comma-separated social media links');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
