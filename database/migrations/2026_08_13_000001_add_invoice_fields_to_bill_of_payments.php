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
        Schema::table('bill_of_payments', function (Blueprint $table) {
            $table->string('invoice_no')->nullable()->after('payment_name');
            $table->decimal('contract_value', 20, 2)->nullable()->after('invoice_no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bill_of_payments', function (Blueprint $table) {
            $table->dropColumn(['invoice_no', 'contract_value']);
        });
    }
};
