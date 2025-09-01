<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributs', function (Blueprint $table) {
            $table->id();
            $table->string('surface')->nullable();
          
            $table->decimal('single_price', 13, 3)->nullable();
            $table->decimal('double_price', 13, 3)->nullable();
             $table->decimal('triple_price', 10, 2)->nullable();
        

            $table->unsignedBigInteger('room_id')->nullable();

            
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
        Schema::dropIfExists('attributs');
    }
}
