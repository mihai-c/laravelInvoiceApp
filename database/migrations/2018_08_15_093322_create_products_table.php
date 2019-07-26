<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('sku',50);
            $table->string('product_name',150);
            $table->decimal('price',10,2);
            $table->decimal('client_price',10,2)->nullable();
            $table->decimal('weight',10,3)->nullable();
            $table->string('currency',3);
            $table->text('description')->nullable();
            $table->string('product_um',5);
            $table->integer('client_id')->unsigned()->nullable();
            $table->string('default_img',200)->nullable();

            $table->foreign('client_id')->references('id')->on('clients')->onDelete(' set null');
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
        Schema::dropIfExists('products');
    }
}
