<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annual_budgets', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('accountchart_id')->unsigned();
            $table->integer('budget_year');
            $table->decimal('amount', 11, 2);
            $table->timestamps();
            $table->foreign('accountchart_id')->references('id')->on('account_charts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('annual_budgets');
    }
};
