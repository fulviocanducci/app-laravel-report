<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('fantasy');
            $table->string('site')->nullable();
            $table->string('email')->nullable();

            $table->string('image')->nullable();

            $table->enum('type', ['F', 'J'])->default('F')->comment('F -> Física, U -> Jurídica');

            $table->string('cpf')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('rg')->nullable();
            $table->date('date_birth')->nullable();


            $table->string('cellphone')->nullable();
            $table->string('telephone')->nullable();

            $table->string('partner')->nullable();
            $table->enum('marital_status', ['Solteiro', 'Casado', 'Separado', 'Divorciado', 'Viúvo'])->nullable();
            $table->string('father')->nullable();
            $table->string('mother')->nullable();
            $table->string('naturalness')->nullable();
            $table->string('nationality')->nullable();
            $table->string('office')->nullable();


            $table->text('observation')->nullable();
            $table->enum('status', ['A', 'I'])->default('A')->comment('A -> Ativo, I -> Inativo');


            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('origin_id')->unsigned()->nullable();


            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            
            /*
            $table->foreign('origin_id')
                ->references('id')
                ->on('origins')
                ->onDelete('cascade');
            */

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('people');
    }
}
