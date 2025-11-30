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
        Schema::create('app_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('listing_id');
            $table->string('order_id')->nullable();
            $table->string('status')->default('pending'); // pending, succeeded, failed
            $table->decimal('amount', 10, 2);
            $table->timestamps();

            $table->foreign('listing_id')->references('id')->on('client_listing');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_payments');
    }
};
