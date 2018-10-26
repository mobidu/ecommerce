<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUlasansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('ulasan')){
            Schema::create('ulasan', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('id_ulasan')->nullable();
                $table->integer('id_barang');
                $table->integer('id_customer');
                $table->integer('rating');
                $table->string('deskripsi');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ulasan');
    }
}
