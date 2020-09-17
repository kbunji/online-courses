<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    const LANGUAGE_RUSSIAN = 1;
    const INFINITELY_USERS = 0;
    const CURRENCY_USD = 3;
    const CURRENCY_RUB = 2;
    const CURRENCY_KZT = 1;
    const PRICE_FREE = 0;
    const SKILL_BEGINNER = 0;
    const STATUS_CREATED = 0;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('title_meta');
            $table->text('about');
            $table->tinyInteger('status')->default(self::STATUS_CREATED);
            $table->integer('teacher_id');
            $table->integer('category_id');
            $table->tinyInteger('skill_level')->default(self::SKILL_BEGINNER);
            $table->tinyInteger('language')->default(self::LANGUAGE_RUSSIAN);
            $table->text('result')->nullable();
            $table->text('requirements')->nullable();
            $table->text('listeners')->nullable();
            $table->integer('max_students')->default(self::INFINITELY_USERS);
            $table->tinyInteger('currency_id')->default(self::CURRENCY_KZT);
            $table->float('price')->default(self::PRICE_FREE);
            $table->float('discount')->nullable();
            $table->timestamp('discount_expired_at')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('finished_at')->nullable();
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
        Schema::dropIfExists('courses');
    }
}
