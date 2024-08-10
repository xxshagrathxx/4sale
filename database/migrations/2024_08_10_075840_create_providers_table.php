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
        Schema::create('providers', function (Blueprint $table) {
            $table->id();

            $table->integer('balance');
            $table->string('currency');
            $table->string('email');
            $table->enum('status', ['authorised', 'decline', 'refunded'])->default('decline');
            $table->date('registration_date');
            $table->string('identification')->unique();
            $table->string('reference');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('providers');
    }
};
