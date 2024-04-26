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
        Schema::create('setting', function (Blueprint $table) {
            $table->id();
            $table->string('school_name')->nullable();
            $table->text('exam_description')->nullable();
            $table->string('paypal_email')->nullable();
            $table->string('stripe_key', 500)->nullable();
            $table->string('stripe_secret', 500)->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon_icon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting');
    }
};