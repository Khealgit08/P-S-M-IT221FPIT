<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierAuditsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('supplier_audits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_id');
            $table->date('audit_date');
            $table->string('auditor');
            $table->text('findings');
            $table->text('recommendations')->nullable();
            $table->string('status');
            // Audit scheduling and corrective action fields
            $table->date('next_audit_date')->nullable();
            $table->boolean('notification_sent')->default(false);
            $table->text('corrective_actions')->nullable();
            $table->timestamps();

            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_audits');
    }
};
