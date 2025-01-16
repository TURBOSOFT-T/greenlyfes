<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('logement_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();


            $table->string('name')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->longText('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('active')->default(true);
       



            $table->string('title')->nullable();

            $table->string('seo_title')->nullable();
            $table->longText('excerpt')->nullable();
            $table->longText('body')->nullable();
            $table->longText('meta_description')->nullable();
            $table->longText('meta_keywords')->nullable();
            

          
          

           
            $table->string('tags')->nullable();
            $table->decimal('originalPrice')->nullable();
            $table->decimal('discountPrice')->nullable();


            $table->integer('stock')->nullable();
            $table->integer('stock_alert')->nullable();
            $table->string('cover')->nullable();
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
        Schema::dropIfExists('books');
    }
}
