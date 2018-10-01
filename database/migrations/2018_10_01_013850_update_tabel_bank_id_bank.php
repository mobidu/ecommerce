<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTabelBankIdBank extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('banks')){
            Schema::table('banks', function(Blueprint $table){

               if(Schema::hasColumn('banks', 'kode_bank')){
                   $table->dropColumn('kode_bank');
               }

               if(Schema::hasColumn('banks', 'nama_bank')){
                   $table->dropColumn('nama_bank');
               }

               if(!Schema::hasColumn('banks', 'id_bank')){
                   $table->integer('id_bank')->unsigned();
               }
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
        if(Schema::hasTable('banks')){
            Schema::table('banks', function(Blueprint $table){
                if(!Schema::hasColumn('banks', 'kode_bank')){
                    $table->string('banks', 255);
                }

                if(!Schema::hasColumn('banks', 'nama_bank')){
                    $table->string('nama_bank', 255);
                }

                if(Schema::hasColumn('banks', 'id_bank')){
                    $table->dropColumn('id_bank');
                }
            });
        }
    }
}
