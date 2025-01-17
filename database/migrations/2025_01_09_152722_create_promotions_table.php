<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('titre')->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->integer("pourcentage")->nullable();
            $table->dateTime("debut")->nullable();
            $table->dateTime("fin")->nullable();
            $table->enum("statut", ["Programmer","En cours", "Terminer"])->default("Programmer");
      
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
        Schema::dropIfExists('promotions');
    }
}
