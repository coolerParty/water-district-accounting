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
        Schema::create('disbursements', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('journal_entry_voucher_id')->unsigned();
            $table->integer('dv_number');
            $table->string('payee');
            $table->text('particulars');
            $table->string('check_number');
            $table->decimal('amount', 11, 2);
            $table->string('tin_no');
            $table->string('address');
            $table->string('fpa');
            $table->enum('type_of_fund',['general','retirement']);
            $table->boolean('mds')->default(false);
            $table->boolean('commercial')->default(false);
            $table->boolean('ada')->default(false);
            $table->boolean('cash_in_available')->default(false);
            $table->boolean('subject_to_ada')->default(false);
            $table->boolean('others')->default(false);
            $table->boolean('check_withdrawn')->default(false);
            $table->bigInteger('bank_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('journal_entry_voucher_id')->references('id')->on('journal_entry_vouchers')->onDelete('cascade');
            $table->foreign('bank_id')->references('id')->on('banks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disbursements');
    }
};
