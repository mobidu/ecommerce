<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableUlasan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('ulasan'))
        {
            Schema::table('ulasan', function (Blueprint $table){
                if(!Schema::hasColumn('ulasan', 'id_order')){
                    $table->integer('id_order');
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
        Schema::table('ulasan', function (Blueprint $table){
            if(Schema::hasColumn('ulasan', 'id_order')){
                $table->dropColumn('id_order');
            }
        });
    }
}
