<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoneyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('money', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emissionId');
            $table->unsignedBigInteger('scwpmId');
            $table->unsignedBigInteger('kuphurId');
            $table->unsignedBigInteger('serieId');
            $table->unsignedBigInteger('tertipId');
            $table->unsignedBigInteger('printPlace');
            $table->string('value');
            $table->string('cilValue');
            $table->string('tValue');
            $table->string('size');
            $table->date('tedavulDate');
            $table->date('lastDate');
            $table->date('zortedDate');
            $table->date('timeoutDate');
            $table->date('expiryDate');
            $table->string('frontColor');
            $table->string('backColor');
            $table->string('frontImage');
            $table->string('backImage');
            $table->string('link');
            $table->string('desc')->nullable();
            $table->enum('status',[0,1])->default(0);
            $table->timestamps();
            $table->foreign('emissionId')->references('id')->on('emissions')->onDelete('cascade');
            $table->foreign('scwpmId')->references('id')->on('scwpms')->onDelete('cascade');
            $table->foreign('kuphurId')->references('id')->on('kuphurs')->onDelete('cascade');
            $table->foreign('serieId')->references('id')->on('series')->onDelete('cascade');
            $table->foreign('tertipId')->references('id')->on('tertips')->onDelete('cascade');
            $table->foreign('printPlace')->references('id')->on('print_places')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('money');
    }
}
