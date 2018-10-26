<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiskusisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diskusi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent')->nullable();
            $table->integer('id_barang');
            $table->integer('id_user')->nullable();
            $table->integer('id_customer')->nullable();
            $table->text('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diskusi');
    }
}
