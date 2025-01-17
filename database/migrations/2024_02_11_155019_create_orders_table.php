<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_ref_id')->nullable();
            $table->timestamp('order_at')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->decimal('order_amount', 10, 2)->default(0.00);

            //
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();

            $table->string('phone')->nullable();
            $table->string('note')->nullable();

            $table->enum("statut", ['créé', 'traitement', ' En cours livraison', 'livrée', 'payée','planification','retournée'])->default('créé');
            $table->enum("mode", ["espèce","paypal","carte de credit"])->default("espèce");
            $table->enum("etat",["attente","confirmé","annulé"])->default("attente") ;
            
            $table->string('reference', 8)->nullable();
            $table->decimal('shipping')->nullable();
            $table->decimal('total')->nullable();
            $table->decimal('tax')->nullable();
            $table->enum('payment', [
                'carte',
                'mandat',
                'virement',
                'cheque'
            ])->nullable();
            $table->string('purchase_order', 100)->nullable();
            $table->boolean('pick')->default(false);
            $table->integer('invoice_id')->nullable();
            $table->string('invoice_number', 40)->nullable();
            // $table->foreignId('state_id')->constrained()->onDelete('cascade');
            //$table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('state_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
