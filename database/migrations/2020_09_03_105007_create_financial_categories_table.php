<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancialCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('financial_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->enum('type', ['Despesa', 'Receita']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('financial_categories');
    }
}
