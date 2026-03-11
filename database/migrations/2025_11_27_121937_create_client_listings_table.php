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
        Schema::create('client_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade');
            $table->string('location');
            $table->integer('number_of_persons');
            $table->decimal('total_rent', 10, 2);
            $table->decimal('rent_for_you', 10, 2);
            $table->string('floor');
            $table->boolean('has_elevator');
            $table->boolean('has_parking');
            $table->string('occupation');
            $table->string('gender');
            $table->string('facilities');
            $table->string('personal_habbits');
            $table->string('images');
            $table->text('notes')->nullable();
            $table->string('status')->default('pending');
            $table->text('remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_listings');
    }
};
