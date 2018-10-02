<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableSettingMapDeskripsi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('settings')){
            Schema::table('settings', function(Blueprint $table){

               if(!Schema::hasColumn('settings', 'map')){
                   $table->text('map')->nullable();

               }

               if(!Schema::hasColumn('settings', 'deskripsi_lengkap')){
                   $table->text('deskripsi_lengkap')->nullable();
               }

                if(!Schema::hasColumn('settings', 'banner_toko')){
                    $table->string('banner_toko')->nullable();
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
        if(Schema::hasTable('settings')){
            Schema::table('settings', function(Blueprint $table){
                if(Schema::hasColumn('settings', 'map')){
                    $table->dropColumn('map');

                }

                if(Schema::hasColumn('settings', 'deskripsi_lengkap')){
                    $table->dropColumn('deskripsi_lengkap');
                }

                if(Schema::hasColumn('settings', 'banner_toko')){
                    $table->dropColumn('banner_toko');
                }
            });
        }
    }
}
