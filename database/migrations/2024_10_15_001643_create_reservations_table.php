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
        
            $table->date('date_debut');
            $table->date('date_fin');
            $table->date('limit');
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

            $table->enum("mode", ["espèce","paypal","carte de credit","cheque"])->default("espèce");
            $table->enum("etat",["attente","confirmé","annulé"])->default("attente") ;
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
