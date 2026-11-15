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
        Schema::table('deliveries', function (Blueprint $table) {
            $table->string('document_no')->nullable();
            $table->string('customer')->nullable();
            $table->string('section')->nullable();
            $table->string('rev')->nullable();
            $table->string('assembly_no')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('class')->nullable();
            $table->string('description')->nullable();
            $table->decimal('length_mm', 10, 2)->nullable();
            $table->decimal('weight_kg', 10, 2)->nullable();
            $table->decimal('total_weight_kg', 10, 2)->nullable();
            $table->text('remark')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('deliveries', function (Blueprint $table) {
            $table->dropColumn([
                'document_no', 'customer', 'section', 'rev', 'assembly_no',
                'quantity', 'class', 'description', 'length_mm', 'weight_kg',
                'total_weight_kg', 'remark'
            ]);
        });
    }
};
