<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('code',6)->nullable();
            $table->string('company',150);
            $table->string('cif',50);
            $table->string('attr_fiscal',3)->nullable();
            $table->string('reg',100)->nullable();
            $table->string('address',250);
            $table->string('judet',150);
            $table->string('city',150);
            $table->string('zip',50)->nullable();
            $table->string('contact_person',250)->nullable();
            $table->string('phone',50)->nullable();
            $table->string('email',100)->nullable();
            $table->string('country',100)->nullable();
            $table->string('iban',100)->nullable();
            $table->string('banca',100)->nullable();
            $table->string('logo',150)->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
        //
    }
}
