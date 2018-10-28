<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePencairanSaldosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('pencairan_saldo')){
            Schema::create('pencairan_saldo', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('id_penarikan');
                $table->double('jumlah', 10, 2);
                $table->string('bukti');
                $table->integer('id_rekening');
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
        Schema::dropIfExists('pencairan_saldo');
    }
}
