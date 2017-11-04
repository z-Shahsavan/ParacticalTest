<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('to_dos_id')->unsigned();
            $table->foreign('to_dos_id')->references('id')->on('to_dos');
            $table->string('title');
            $table->string('taskdesc');
            $table->tinyInteger('status');//0=new;1=done;2=canceled;3=failed;4=extended
            $table->time('duedate');
            $table->tinyInteger('sort');
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
        Schema::dropIfExists('tasks');
    }
}
