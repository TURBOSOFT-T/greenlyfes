<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePdfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pdfs', function (Blueprint $table) {
            $table->id();
            $table->string('file_name'); // Nom du fichier PDF
            $table->string('file_path'); // Chemin du fichier PDF
            $table->timestamps();
        });

        Schema::create('pdf_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pdf_id')->constrained('pdfs')->onDelete('cascade'); // Clé étrangère vers le PDF
            $table->string('image_path'); // Chemin de l'image convertie
            $table->integer('page_number'); // Numéro de la page
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
        Schema::dropIfExists('pdf_images');
        Schema::dropIfExists('pdfs');
    }
}
