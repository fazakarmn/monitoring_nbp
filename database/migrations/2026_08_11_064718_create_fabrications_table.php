<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('fabrication_components', function (Blueprint $table) {
            $table->id();
            $table->string('contract_no')->default('0');
            $table->string('part_no');
            $table->string('description');
            $table->integer('qty_target')->default(0);
            $table->integer('qty_cutting')->default(0);
            $table->integer('qty_fitup')->default(0);
            $table->integer('qty_welding')->default(0);
            $table->integer('qty_finishing')->default(0);
            $table->string('welder_id')->nullable();
            $table->string('wps_ref')->nullable();
            $table->string('pic')->nullable();
            $table->date('start_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('fabrication_components');
    }
};
