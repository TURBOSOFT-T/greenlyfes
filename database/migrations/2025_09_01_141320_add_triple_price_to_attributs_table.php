<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTriplePriceToAttributsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attributs', function (Blueprint $table) {
             $table->decimal('triple_price', 10, 2)->nullable()->after('double_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attributs', function (Blueprint $table) {
             $table->dropColumn('triple_price');
        });
    }
}
