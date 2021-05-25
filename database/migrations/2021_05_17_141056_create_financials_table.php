<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancialsTable extends Migration
{
    public function up()
    {
        Schema::create('financials', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['Pagar', 'Receber']);
            $table->foreignId('financial_category_id')->constrained();
            $table->foreignId('financial_account_id')->constrained();
            $table->foreignId('person_id')->constrained();
            $table->foreignId('process_id')->nullable()->constrained();
            $table->text('description')->nullable();
            $table->string('document');
            $table->decimal('original',12,2);
            $table->decimal('discount',12,2)->default(0);
            $table->decimal('fine',12,2)->default(0);
            $table->decimal('rate',12,2)->default(0);
            $table->decimal('credit',12,2)->default(0);
            $table->decimal('payment', 12,2)->default(0);
            $table->date('competence');
            $table->date('due_date');
            $table->date('payday')->nullable();
            $table->enum('honorary', ['S', 'N'])->default('N')->comment('S -> Sim, N -> Não');


            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('financials');
    }
}
