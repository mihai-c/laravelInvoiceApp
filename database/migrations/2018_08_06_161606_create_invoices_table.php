<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('invoice_serial',10);
            $table->string('invoice_number',10);
            $table->decimal('invoice_total',12,2);
            $table->string('invoice_currency',3);
            $table->string('exchange_currency',3)->nullable();
            $table->decimal('exchange_rate',6,4)->nullable();
            $table->text('invoice_comments')->nullable();
            $table->text('invoice_notes')->nullable();
            $table->integer('invoice_date');
            $table->integer('payment_date')->nullable();
            $table->integer('invoice_status');
            $table->integer('client_id')->unsigned()->nullable();
            $table->string('client_name',150);
            $table->string('client_cif',50);
            $table->string('client_reg',100)->nullable();
            $table->string('client_iban',30)->nullable();
            $table->string('client_banca',100)->nullable();
            $table->string('client_address',250);
            $table->string('client_judet',150);
            $table->string('client_city',150);
            $table->string('client_zip',50)->nullable();
            $table->string('client_email',100)->nullable();
            $table->string('invoice_issuer',100)->nullable();
            $table->string('invoice_delegat',100)->nullable();
            $table->string('delegat_cnp',13)->nullable();
            $table->string('delegat_ci',15)->nullable();
            $table->string('invoice_shipping_number',15)->nullable();
            $table->string('delivery_car',15)->nullable();
            $table->string('shipping_on',15)->nullable();
            $table->string('shipping_at',15)->nullable();
            $table->integer('user_id')->unsigned()->nullable();

            $table->foreign('client_id')->references('id')->on('clients')->onDelete(' set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete(' set null');

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
        Schema::dropIfExists('invoices.txt');
    }
}
