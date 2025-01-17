<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable()->default(null);
            $table->string('logoHeader')->nullable()->default(null);
            $table->string('image')->nullable()->default(null);
            $table->string('imagelogin')->nullable()->default(null);
            $table->string('imagergister')->nullable()->default(null);
            $table->string('imageabout')->nullable()->default(null);
            $table->string('imageservice')->nullable()->default(null);
            $table->string('imagefooter')->nullable()->default(null);
            $table->string('imageteam')->nullable()->default(null);
            $table->string('imageblog')->nullable()->default(null);
            $table->string('imagefaq')->nullable()->default(null);
            $table->string('imageservices')->nullable()->default(null);
            $table->string('imageclient')->nullable()->default(null);
            $table->string('imagecontact')->nullable()->default(null);

            $table->string('imageecole')->nullable()->default(null);
            $table->string('imagesante')->nullable()->default(null);
            $table->string('imageindustrielle')->nullable()->default(null);
            $table->string('imageeducation')->nullable()->default(null);


            $table->text('mission')->nullable();
            $table->text('vision')->nullable();
            $table->text('valeurs')->nullable();
            $table->text('equipe')->nullable();
            $table->text('domaine')->nullable();
            $table->text('des_contact')->nullable();
            $table->text('description')->nullable()->default(null);
            $table->text('descriptions')->nullable();
          


            $table->string('telephone')->nullable()->default(null);
            $table->string('addresse')->nullable()->default(null);
            $table->string('email')->nullable()->default(null);
           
            $table->decimal("frais", 10,3)->nullable();
           
            $table->integer('annee')->nullable();
            $table->integer('utilisateur')->nullable();
            $table->integer('dossier')->nullable();
            $table->integer('projet')->nullable();
            $table->string('icon')->nullable()->default(null);
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
        Schema::dropIfExists('configs');
    }
}
