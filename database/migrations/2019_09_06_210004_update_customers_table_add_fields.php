<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCustomersTableAddFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::dropIfExists('customers');
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->integer('ident_number');
            $table->integer('Type');
            $table->integer('saudi_id');
            $table->dateTime('saudi_id_date');
            $table->string('saudi_id_exp', 100);
            $table->string('address', 100);
            $table->string('nationality', 100);
            $table->integer('phone');
            $table->string('company_name', 100);
            $table->string('job', 100);
            $table->string('created_by', 100);
            $table->string('updated_by', 100);
            $table->string('file', 100);
            $table->integer('sp_id');
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
        Schema::dropIfExists('customers');
    }
}
