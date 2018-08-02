<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerhitunganObatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perhitungans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('obat_id');
            $table->date('bulan');
            $table->integer('x');
            $table->integer('y');
            $table->integer('x2');
            $table->integer('xy');

            $table->timestamps();

            $table->foreign('obat_id')->references('id')->on('obats');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perhitungans');
    }
}
