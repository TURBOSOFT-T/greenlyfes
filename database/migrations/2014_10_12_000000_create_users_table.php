<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            //$table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            //  $table->uuid('id')->primary();
            //    $table->uuid('id')->primary();



            $table->string('name')->nullable();
            $table->string('firstName')->nullable();
            $table->string('email')->unique();
            $table->bigInteger('code')->unique()->nullable();;
            $table->enum('registration_type', array('INDIVIDUAL', 'CORPORATE'))->default('INDIVIDUAL');

            $table->string('image_path')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->date('birth_day')->nullable();
            $table->string('gender')->nullable();

            $table->string('country')->nullable();
            $table->string('region')->nullable();
            $table->string('category')->nullable();

            $table->string('currency')->nullable();

            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table
                ->enum('role', [
                    'user',
                    'redac',
                    'admin',
                    'seller',

                    'manger',

                ])
                ->default('user');

            $table->string('avatar')->nullable();
            $table->boolean('status')->default(0);
            $table->boolean('valid')->default(true);
            $table->tinyInteger('isban')->default('0'); //Add in UserTable before timestamps

            $table->boolean('approved')->default(0);
            //    $table->boolean('is_activated');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
