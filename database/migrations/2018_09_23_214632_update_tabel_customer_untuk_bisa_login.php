<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTabelCustomerUntukBisaLogin extends Migration
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
                if(!Schema::hasColumn('customers','username')){
                    $table->string('username')->nullable();
                }

                if(!Schema::hasColumn('customers','email')){
                    $table->string('email')->unique();
                }

                if(!Schema::hasColumn('customers','password')){
                    $table->string('password')->nullable();
                }

                if(!Schema::hasColumn('customers','referred_by')){
                    $table->string('referred_by')->nullable();
                }

                if(!Schema::hasColumn('customers','affiliate_id')){
                    $table->string('affiliate_id')->unique();
                }

                if(!Schema::hasColumn('customers','remember_token')){
                    $table->rememberToken();
                }

                if(Schema::hasColumn('customers','pinbbm')){
                    $table->string('pinbbm')->nullable()->change();
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
            Schema::table('customer', function(Blueprint $table){
                if(Schema::hasColumn('customers','username')){
                    $table->removeColumn('username');
                }

                if(Schema::hasColumn('customers','email')){
                    $table->removeColumn('email');
                }

                if(Schema::hasColumn('customers','password')){
                    $table->removeColumn('password');
                }

                if(Schema::hasColumn('customers','referred_by')){
                    $table->removeColumn('referred_by');
                }

                if(Schema::hasColumn('customers','affiliate_id')){
                    $table->removeColumn('affiliate_id');
                }

            });
        }
    }
}
