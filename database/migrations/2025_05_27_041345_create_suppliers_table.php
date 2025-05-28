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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('contact_person');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('address');
            $table->string('status'); // e.g., active, inactive, blacklisted
            // Compliance/certification fields
            $table->string('certification')->nullable();
            $table->date('certification_expiry')->nullable();
            $table->boolean('compliance_status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
