<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //roles uses CRUDTS system 
        // C - CREATE permission 
        // R - READ permission 
        // U - UPDATE permission 
        // D - DELETE permission 
        // T - TABLE_SCHEDULE permission 
        // S - SEARCH permission
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('role_id')->key();
            $table->string('role_name' ) ;

            $table->smallInteger('installments')->length(2) ;  
            $table->smallInteger('users')->length(2) ;  
            $table->smallInteger('store')->length(2) ;  
            $table->smallInteger('customers')->length(2) ;  
            $table->smallInteger('custody')->length(2) ;  
            $table->smallInteger('roles')->length(2) ;  
            $table->smallInteger('sponsors')->length(2) ;  
            $table->smallInteger('reports')->length(2) ;  
            $table->smallInteger('operations_log')->length(2) ;  
             
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
