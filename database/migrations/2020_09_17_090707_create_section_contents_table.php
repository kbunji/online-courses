<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionContentsTable extends Migration
{
    const FREE_FALSE = false;
    const TYPE_VIDEO = 1;
    const TYPE_DOCUMENT = 2;
    const TYPE_TEST = 3;
    const TYPE_HTML = 4;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('content_type');
            $table->integer('position');
            $table->integer('is_free')->default(self::FREE_FALSE);
            $table->integer('section_id');
            $table->string('path');
            $table->string('url');
            $table->string('url_youtube');
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
        Schema::dropIfExists('section_contents');
    }
}
