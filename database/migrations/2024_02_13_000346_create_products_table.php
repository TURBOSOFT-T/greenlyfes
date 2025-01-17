<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->longText('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('active')->default(true);
            $table->decimal('price')->nullable();
            $table->string('tags')->nullable();
            $table->decimal('originalPrice')->nullable();
            $table->decimal('discountPrice')->nullable();


            $table->integer('stock')->nullable();
            $table->integer('stock_alert')->nullable();
            $table->string('image')->nullable();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            /* $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
            $table->foreign('category_id')
            ->references('id')
            ->on('categories')
            ->onDelete('cascade'); */
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
        Schema::dropIfExists('products');
    }
}
