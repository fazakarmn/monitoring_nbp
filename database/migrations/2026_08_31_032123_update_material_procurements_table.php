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
        Schema::table('material_procurements', function (Blueprint $table) {
            $table->dropColumn(['note', 'total_weight_kg', 'commercial_qty']);
            $table->renameColumn('material', 'part_no');
            $table->renameColumn('vendor', 'supplier');
            
            $table->string('no_po')->nullable();
            $table->integer('qty_ordered')->default(0);
            $table->integer('qty_received')->default(0);
            $table->decimal('harga_satuan', 15, 2)->default(0);
            $table->date('tanggal_po')->nullable();
            $table->date('eta')->nullable();
            $table->date('tanggal_tiba')->nullable();
            $table->string('mtc')->nullable();
            $table->string('no_surat_jalan')->nullable();
            $table->string('termin_pembayaran')->nullable();
            $table->string('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Not needed for down since it's empty
    }
};
