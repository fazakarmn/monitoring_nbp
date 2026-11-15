<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('material_procurements', function (Blueprint $table) {
            $table->string('deskripsi')->nullable();
            $table->string('qty')->nullable();
            $table->string('grade')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('material_procurements', function (Blueprint $table) {
            $table->dropColumn(['deskripsi', 'qty', 'grade']);
        });
    }
};
