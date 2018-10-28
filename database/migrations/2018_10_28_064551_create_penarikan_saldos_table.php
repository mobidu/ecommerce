<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenarikanSaldosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('penarikan_saldo')){
            Schema::create('penarikan_saldo', function (Blueprint $table) {
                $table->increments('id');
                $table->string('id_affiliate');
                $table->double('jumlah');
                $table->enum('status', ['menunggu', 'selesai']);
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
        Schema::dropIfExists('penarikan_saldo');
    }
}
