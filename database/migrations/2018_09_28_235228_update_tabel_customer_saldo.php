<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTabelCustomerSaldo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('customers')){
            Schema::table('customers', function(Blueprint $table){
                if(!Schema::hasColumn('customers', 'saldo')){
                    $table->double('saldo', 10, 2)->nullable();
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
        if(Schema::hasTable('customers')){
            Schema::table('customers', function(Blueprint $table){
                if(Schema::hasColumn('customers', 'saldo')){
                    $table->dropColumn('saldo');
                }
            });
        }
    }
}
