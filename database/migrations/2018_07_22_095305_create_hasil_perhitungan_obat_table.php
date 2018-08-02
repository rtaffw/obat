<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHasilPerhitunganObatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasils', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('obat_id');
            $table->date('bulan')->default('0000-01-01');

            $table->double('x', 8, 2)->nullable();
            $table->double('x2', 8, 2)->nullable();
            $table->double('xy', 8, 2)->nullable();
            $table->double('y', 8, 2)->nullable();
            $table->double('a', 8, 2)->nullable();
            $table->double('b', 8, 2)->nullable();
            $table->double('c', 8, 2)->nullable();

            $table->unsignedInteger('xt')->nullable();
            $table->unsignedInteger('n')->nullable();




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
        Schema::dropIfExists('hasils');
    }
}
