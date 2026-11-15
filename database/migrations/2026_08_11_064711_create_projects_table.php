<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('customer');
            $table->string('bridge_type');
            $table->string('work_order')->unique();
            $table->date('timeline_start');
            $table->date('timeline_end');
            $table->decimal('bill_of_quantity_ton', 8, 2)->nullable();
            $table->enum('status', ['done', 'on-going', 'pending'])->default('pending');
            // Progress percentages for each stage
            $table->integer('prog_bill_of_payment')->default(0);
            $table->integer('prog_design_engineering')->default(0);
            $table->integer('prog_bill_of_material')->default(0);
            $table->integer('prog_material_take_off')->default(0);
            $table->integer('prog_material_procurement')->default(0);
            $table->integer('prog_fabrication')->default(0);
            $table->integer('prog_galvanized')->default(0);
            $table->integer('prog_delivery')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
