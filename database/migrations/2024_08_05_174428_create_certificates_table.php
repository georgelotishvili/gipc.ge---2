<?php

use App\Enums\CertificateStatus;
use App\Models\User;
use App\Models\Speciality;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Speciality::class);
            $table->foreignIdFor(User::class);
            $table->string('certificate_number')->unique();
            $table->date('release_date')->default(now());
            $table->integer('lifetime_years')->default(5);
            $table->enum('status', array_column(CertificateStatus::cases(), 'value'))->default(CertificateStatus::PENDING->value);
            $table->string('location')->nullable();
            $table->string('education')->nullable();
            $table->string('experience')->nullable();
            $table->string('social')->nullable()->comment('Comma-separated social media links');
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->decimal('score', 8, 2)->nullable();
            $table->decimal('rate', 5, 2)->nullable();
            $table->integer('jury_count')->default(0);
            $table->integer('stars')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
