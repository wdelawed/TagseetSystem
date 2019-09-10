<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstallmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description') ;
            $table->bigInteger('price') ;
            $table->integer('commodity_id')->unsigned() ; //foreign key 
            $table->integer('customer_id')->unsigned() ;  //foreign key
            $table->bigInteger('total_cost')->unsigned() ;
            $table->integer('installment_duration') ;
            $table->bigInteger('monthly_payment') ; 
            $table->bigInteger('first_payment') ;
            $table->float('interest') ;
            $table->integer('schedule_id')->unsigned() ; // foreign key
            $table->integer('schedule_duration') ;
            $table->integer('management_fees') ;
            $table->integer('creater_id')->unsigned() ; //foreign key

            $table->foreign('customer_id')->references('id')->on('customers') ;
            $table->foreign('commodity_id')->references('id')->on('commodities') ;
            
            $table->foreign('creater_id')->references('user_id')->on('users') ;
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
        Schema::dropIfExists('installments');
    }
}
