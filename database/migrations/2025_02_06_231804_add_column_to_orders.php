<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('payment_method', ['stripe', 'bank_transfer'])->default('bank_transfer'); // Mode de paiement
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending'); // Statut du paiement
            $table->string('transaction_id')->nullable(); // ID de transaction Stripe (si applicable)
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('payment_method');
            $table->dropColumn('payment_status');
            $table->dropColumn('transaction_id');
        });
    }
}
