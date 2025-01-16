<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('reservation_id')->nullable();
            $table->unsignedBigInteger('room_id')->nullable();
         
         
            $table->integer("nb_personnes")->nullable();
          
            $table->decimal('prix_unitaire', 13, 3)->default(10);
            $table->decimal('prix', 13, 3)->nullable();
            $table->decimal('benefice', 13, 3)->default();
            $table->decimal('total', 13, 3)->default(10);
            $table->unsignedBigInteger('payment_method_id')->nullable();
           

          


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
        Schema::dropIfExists('reservations_items');
    }
}
