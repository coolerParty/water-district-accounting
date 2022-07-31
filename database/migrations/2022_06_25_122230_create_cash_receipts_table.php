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
        Schema::create('cash_receipts', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('journal_entry_voucher_id')->unsigned();
            $table->string('official_receipt');
            $table->string('a_receipt'); // Acknowledgement Receipt
            $table->decimal('current', 11, 2);
            $table->decimal('penalty', 11, 2);
            $table->decimal('arrears_cy', 11, 2);
            $table->decimal('arrears_py', 11, 2);
            $table->decimal('cod_prev_day', 11, 2); // cash on hand previous day
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
        Schema::dropIfExists('cash_receipts');
    }
};
