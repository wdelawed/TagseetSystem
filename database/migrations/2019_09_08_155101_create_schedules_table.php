<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('installment_id')->unsigned() ; //foreign key
            $table->integer('bank_id')->unsigned() ; //foreign key
            $table->string('bank_receipt') ;
            $table->date('scheduled_date') ;
            $table->bigInteger('amount') ;
            $table->bigInteger('payed') ;
            $table->bigInteger('remaining') ;
            $table->string('status') ;
            $table->boolean('cash') ;

            $table->foreign('installment_id')->references('id')->on('installments') ;
            $table->foreign('bank_id')->references('id')->on('banks') ;
            
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
        Schema::dropIfExists('schedules');
    }
}
