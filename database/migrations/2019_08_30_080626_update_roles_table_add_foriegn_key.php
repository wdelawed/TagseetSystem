<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRolesTableAddForiegnKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //add column role_id to users table
        Schema::table('users',function(Blueprint $table){
            $table->integer('role_id')->unsigned() ; 
            $table->foreign('role_id')->references('role_id')->on('roles') ;
        }) ;

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //drop the foriegn key 
        Schema::table('users',function(Blueprint $table){
            $table->dropForeign('users_role_id_foreign') ;
        }) ;
    }
}
