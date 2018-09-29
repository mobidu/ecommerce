<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTabelPaidKonfirmasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('paids')){
            Schema::table('paids', function(Blueprint $table){
                if(!Schema::hasColumn('paids', 'status')){
                    $table->enum('status', ['konfirmasi', 'tolak', 'menunggu'])->default('menunggu')->nullable();
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
        if(Schema::hasTable('paids')){
            Schema::table('paids', function(Blueprint $table){
                if(Schema::hasColumn('paids', 'status')){
                    $table->dropColumn('status');
                }
            });
        }
    }
}
