<?php

use App\Enums\PaymentStatusEnum;
use App\Enums\SubscriptionType;
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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('subscription_type');
            $table->string('order_status');
            $table->decimal('actual_amount', 8, 2);
            $table->string('order_id')->nullable();
            $table->string('card_type')->nullable();
            $table->timestamp('order_time')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('transaction_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
