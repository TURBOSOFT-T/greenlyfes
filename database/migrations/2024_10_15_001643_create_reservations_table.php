<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('room_id');
            
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->date('limit')->nullable();
            $table->boolean('rented')->default(false);
            $table->integer('nb_personnes')->nullable();
       //     $table->decimal('prix_total', 13, 2);
       $table->decimal('prix_total', 13, 2)->nullable();

            $table->string('nom');
            $table->string('prenom');
            $table->string('email');

            $table->string('adresse')->nullable();
            $table->string('ville')->nullable();
            $table->string('pays')->nullable();
            $table->string('telephone')->nullable();
            $table->string('note')->nullable();
            $table->integer("nb_mois")->nullable();

            $table->enum("mode", ["espèce","paypal","carte de credit","cheque"])->default("espèce");
            $table->enum("etat",["attente","confirmé","annulé"])->default("attente") ;
            $table->enum('payment_method', ['stripe', 'bank_transfer'])->default('bank_transfer'); // Mode de paiement
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending'); // Statut du paiement
            $table->string('transaction_id')->nullable(); // ID de transaction Stripe (si applicable)
       
            // relation
        //    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
          //  $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');

            // timestamps
            $table->softDeletes(); // Add soft delete column for history tracking

            // Add created_at and updated_at columns
        
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
        Schema::dropIfExists('reservations');
    }
}
