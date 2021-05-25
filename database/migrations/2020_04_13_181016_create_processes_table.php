<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessesTable extends Migration
{
    public function up()
    {
        Schema::create('processes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('person_id')->unsigned();
            $table->bigInteger('counterpart_id')->unsigned();
            $table->bigInteger('forum_id')->unsigned();
            $table->bigInteger('stick_id')->unsigned();
            $table->bigInteger('district_id')->unsigned();
            $table->bigInteger('group_action_id')->unsigned();
            $table->bigInteger('type_action_id')->unsigned();
            $table->bigInteger('phase_id')->unsigned();
            $table->bigInteger('stage_id')->unsigned();
            $table->string('number_process')->unique();
            $table->string('protocol')->nullable();
            $table->string('folder')->nullable();
            $table->date('date_request')->nullable();
            $table->double('expectancy', 15,2)->nullable();
            $table->double('price', 15,2)->nullable();
            $table->double('percent_fees', 15,2)->nullable();
            $table->text('description')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('person_id')
                ->references('id')
                ->on('people')
                ->onDelete('cascade');
            /*
            $table->foreign('counterpart_id')
                ->references('id')
                ->on('people')
                ->onDelete('cascade');

            $table->foreign('forum_id')
                ->references('id')
                ->on('forums')
                ->onDelete('cascade');

            $table->foreign('stick_id')
                ->references('id')
                ->on('sticks')
                ->onDelete('cascade');

            $table->foreign('district_id')
                ->references('id')
                ->on('districts')
                ->onDelete('cascade');

            $table->foreign('group_action_id')
                ->references('id')
                ->on('group_actions')
                ->onDelete('cascade');

            $table->foreign('type_action_id')
                ->references('id')
                ->on('type_actions')
                ->onDelete('cascade');

            $table->foreign('phase_id')
                ->references('id')
                ->on('phases')
                ->onDelete('cascade');

            $table->foreign('stage_id')
                ->references('id')
                ->on('stages')
                ->onDelete('cascade');
            */
        });
    }

    public function down()
    {
        Schema::dropIfExists('processes');
    }
}
