<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            //   $table->foreignId('hopital_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('hopital_id')->nullable();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email');
            $table->float('telephone')->nullable();
          
            $table->float('adresse')->nullable();
            $table->float('ville')->nullable();
 
            $table->integer('age')->nullable();
            $table->float('taille')->nullable();
            $table->float('poids')->nullable();
            $table->text('message')->nullable();
            $table->boolean('is_read')->default(false);

            $table->timestamps();
        });

        Schema::create('consultation_specialite', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consultation_id')->constrained()->onDelete('cascade');
            $table->foreignId('specialite_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('consultations');
    }
}
