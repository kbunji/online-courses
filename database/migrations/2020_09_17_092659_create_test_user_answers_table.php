<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestUserAnswersTable extends Migration
{
    const RIGHT_FALSE = false;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_user_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('result_id');
            $table->integer('question_id');
            $table->integer('answer_id')->nullable();
            $table->string('answer_text')->nullable();
            $table->boolean('is_right')->default(self::RIGHT_FALSE);
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
        Schema::dropIfExists('test_user_answers');
    }
}
