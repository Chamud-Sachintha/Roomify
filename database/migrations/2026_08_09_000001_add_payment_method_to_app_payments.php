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
        Schema::table('app_payments', function (Blueprint $table) {
            if (!Schema::hasColumn('app_payments', 'payment_method')) {
                $table->string('payment_method')->nullable()->after('order_id');
            }
            if (!Schema::hasColumn('app_payments', 'stripe_payment_id')) {
                $table->string('stripe_payment_id')->nullable()->after('payment_method');
            }
            if (!Schema::hasColumn('app_payments', 'offline_reference')) {
                $table->string('offline_reference')->nullable()->after('stripe_payment_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('app_payments', function (Blueprint $table) {
            if (Schema::hasColumn('app_payments', 'offline_reference')) {
                $table->dropColumn('offline_reference');
            }
            if (Schema::hasColumn('app_payments', 'stripe_payment_id')) {
                $table->dropColumn('stripe_payment_id');
            }
            if (Schema::hasColumn('app_payments', 'payment_method')) {
                $table->dropColumn('payment_method');
            }
        });
    }
};
