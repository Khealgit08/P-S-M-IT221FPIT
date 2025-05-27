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
        Schema::create('supplier_performances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_id');
            $table->date('evaluation_date');
            $table->decimal('quality_score', 5, 2);
            $table->decimal('delivery_score', 5, 2);
            $table->decimal('cost_score', 5, 2);
            $table->decimal('compliance_score', 5, 2);
            $table->decimal('overall_score', 5, 2);
            $table->text('comments')->nullable();
            $table->timestamps();

            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_performances');
    }
};
