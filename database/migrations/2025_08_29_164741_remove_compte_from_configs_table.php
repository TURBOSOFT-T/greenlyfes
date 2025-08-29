<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveCompteFromConfigsTable extends Migration
{
    public function up()
    {
        Schema::table('configs', function (Blueprint $table) {
            if (Schema::hasColumn('configs', 'compte')) {
                $table->dropColumn('compte');
            }
        });
    }

    public function down()
    {
        Schema::table('configs', function (Blueprint $table) {
            $table->string('compte')->nullable()->default(null);
        });
    }
}
