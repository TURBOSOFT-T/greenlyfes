<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Surface;
use Illuminate\Http\Request;

class CreateSurfacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surfaces', function (Blueprint $table) {
            $table->id();
            $table->string('surface')->nullable(); // Surface
            $table->decimal('price', 10, 2)->nullable(); // Prix
            $table->unsignedBigInteger('product_id')->nullable(); // Relation avec le produit

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
        Schema::dropIfExists('surfaces');
    }
}
