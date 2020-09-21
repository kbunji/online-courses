<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    const LANGUAGE_RUSSIAN = 1;
    const STATUS_CREATED = 1;
    const STATUS_VERIFIED = 3;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('login')->unique()->nullable();;
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique();
            $table->string('phone_code')->nullable();
            $table->tinyInteger('status')->default(self::STATUS_CREATED);
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
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
