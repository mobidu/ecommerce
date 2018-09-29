<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTabelBarangKomisi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('products')){
            Schema::table('products', function(Blueprint $table){
                if(!Schema::hasColumn('products', 'komisi')){
                    $table->double('komisi', 10, 2)->nullable();
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
        if(Schema::hasTable('products')){
            Schema::table('products', function(Blueprint $table){
                if(Schema::hasColumn('products', 'komisi')){
                    $table->dropColumn('komisi');
                }
            });
        }
    }
}
