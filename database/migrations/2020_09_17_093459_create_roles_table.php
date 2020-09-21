<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->primary('id');
            $table->string('name');
            $table->timestamps();
        });

        DB::table('roles')->insert(
            array(
                [
                    'id' => 1,
                    'name' => 'Administrator'
                ],
                [
                    'id' => 2,
                    'name' => 'Teacher'
                ],
                [
                    'id' => 3,
                    'name' => 'Student'
                ]
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
