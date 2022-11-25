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
        Schema::create('account_charts', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name')->unique();
            $table->BigInteger('acctgrp_id')->unsigned()->nullable();
            $table->BigInteger('mjracctgrp_id')->unsigned()->nullable();
            $table->BigInteger('submjracctgrp_id')->unsigned()->nullable();
            $table->tinyInteger('current_non')->nullable(); // 1=Current, 2, Non-current,
            $table->timestamps();
            $table->foreign('acctgrp_id')->references('id')->on('account_groups');
            $table->foreign('mjracctgrp_id')->references('id')->on('major_account_groups');
            $table->foreign('submjracctgrp_id')->references('id')->on('sub_major_account_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_charts');
    }
};
