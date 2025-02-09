<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToConfigs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('configs', function (Blueprint $table) {
            $table->string('whtasapp')->nullable()->default(null);
            $table->string('facebook')->nullable()->default(null);
            $table->string('instagram')->nullable()->default(null);
            $table->string('twitter')->nullable()->default(null);
            $table->string('linkedin')->nullable()->default(null);
            $table->string('youtube')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('configs', function (Blueprint $table) {
            $table->dropColumn('whtasapp');
            $table->dropColumn('facebook');
            $table->dropColumn('instagram');
            $table->dropColumn('twitter');
            $table->dropColumn('linkedin');
            $table->dropColumn('youtube');
        });
    }
}
