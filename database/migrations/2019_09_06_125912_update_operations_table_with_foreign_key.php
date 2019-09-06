<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOperationsTableWithForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('operations',function(Blueprint $table){
                $table->foreign('user_id')->references('user_id')->on('users') ;;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('operations',function(Blueprint $table){
            $table->dropForeign('operations_user_id_foreign') ;
        }) ;
    }
}
