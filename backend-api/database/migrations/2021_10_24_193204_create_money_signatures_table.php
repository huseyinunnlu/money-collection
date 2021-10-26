<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoneySignaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('money_signatures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('moneyId');
            $table->unsignedBigInteger('signatureId');
            $table->foreign('moneyId')->references('id')->on('money')->onDelete('cascade');
            $table->foreign('signatureId')->references('id')->on('signatures')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('money_signatures');
    }
}
