<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('material_procurements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->string('material');
            $table->string('note')->nullable();
            $table->decimal('total_weight_kg', 10, 2)->default(0);
            $table->decimal('commercial_qty', 10, 2)->default(0);
            $table->string('vendor')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('material_procurements');
    }
};
