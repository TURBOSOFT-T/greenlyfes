<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('book_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();


            $table->string('name')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->longText('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('active')->default(true);
       



            $table->string('title')->nullable();

            $table->string('seo_title')->nullable();
            $table->text('excerpt')->nullable();
            $table->text('body')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            

          
          

           
            $table->string('tags')->nullable();
            $table->decimal('originalPrice')->nullable();
            $table->decimal('discountPrice')->nullable();


            $table->integer('stock')->nullable();
            $table->integer('stock_alert')->nullable();
            $table->string('image')->nullable();
            $table->string('images')->nullable();
            $table->string('video')->nullable();
           
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
        Schema::dropIfExists('rooms');
    }
}
