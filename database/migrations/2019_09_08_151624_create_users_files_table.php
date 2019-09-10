<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned() ;
            $table->integer('file_id')->unsigned() ; 
            $table->foreign('user_id')->references('user_id')->on('users') ;
            $table->foreign('file_id')->references('id')->on('files') ;
            $table->string('file_path') ;
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
        Schema::dropIfExists('users_files');
    }
}
