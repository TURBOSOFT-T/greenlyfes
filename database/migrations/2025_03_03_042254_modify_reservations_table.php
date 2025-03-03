<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Supprimer les colonnes
            $table->dropColumn(['date_debut', 'date_fin', 'limit']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Ajouter de nouveau les colonnes en cas de rollback
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->date('limit')->nullable();
        });
    }
}
