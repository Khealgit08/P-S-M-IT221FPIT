<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_id');
            $table->string('title');
            $table->text('terms');
            $table->text('sla')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('payment_terms');
            $table->string('discount_terms')->nullable();
            $table->date('payment_due_date')->nullable();
            $table->boolean('payment_alert_sent')->default(false);
            $table->string('status');
            $table->timestamps();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
