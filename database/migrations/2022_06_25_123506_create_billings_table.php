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
        Schema::create('billings', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('journal_entry_voucher_id')->unsigned();
            $table->string('zone');
            $table->integer('metered_sales');
            $table->integer('residential');
            $table->integer('comm');
            $table->integer('comm_a');
            $table->integer('comm_b');
            $table->integer('comm_c');
            $table->integer('government');
            $table->timestamps();
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
        Schema::dropIfExists('billings');
    }
};
