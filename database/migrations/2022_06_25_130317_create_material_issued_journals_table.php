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
        Schema::create('material_issued_journals', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('journal_entry_voucher_id')->unsigned();
            $table->string('rsmi_no');
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
        Schema::dropIfExists('material_issued_journals');
    }
};
