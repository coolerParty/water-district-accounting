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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('accountchart_id')->unsigned();
            $table->BigInteger('journal_entry_voucher_id')->unsigned();
            // $table->foreignId('journal_entry_voucher_id')->constrained();
            $table->decimal('debit', 11, 2);
            $table->decimal('credit', 11, 2);
            $table->timestamps();
            $table->foreign('accountchart_id')->references('id')->on('account_charts');
            $table->foreign('journal_entry_voucher_id')->references('id')->on('journal_entry_vouchers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
