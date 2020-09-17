<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    const LANGUAGE_RUSSIAN = 1;
    const STATUS_ACTIVE = 1;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id');
            $table->string('login')->unique()->nullable();;
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique();
            $table->tinyInteger('status')->default(self::STATUS_ACTIVE);
            $table->string('first_name)');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('country')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->tinyInteger('language')->default(self::LANGUAGE_RUSSIAN);
            $table->string('specialization', 255)->nullable();
            $table->string('website')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('youtube_link')->nullable();
            $table->text('about')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
