<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('material_take_offs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->string('material');
            $table->decimal('length', 10, 2)->default(0);
            $table->decimal('area', 10, 3)->default(0);
            $table->decimal('total_weight_kg', 10, 2)->default(0);
            $table->decimal('allowance_percent', 5, 2)->default(0);
            $table->enum('status', ['Yes', 'No'])->default('No');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('material_take_offs');
    }
};
