<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTermtypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('termtypes', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('paymentterms_id');
            $table->foreign('paymentterms_id')->references('id')->on('paymentterms');
            /*
                Tipo de termino:

                B = Balance (saldo de la factura)
                P = Percentage (porcentaje especifico)
                M = Fixed Mount (un monto fijo)
            */
            $table->string('type', 1);
            /*
                Dias para el vencimiento
            */
            $table->integer('day');
            /*
                Type Invoice Datye - significa vencimiento fecha factura
            */
            $table->boolean('typeid')->nullable();
            /*
                Last day of current month - Vencimiento el ultimo del mes de la factura
            */
            $table->boolean('typeem')->nullable();
            /*
                Last day of next month - Venciemiento el ultimo del mes del mes siguiente la factura
            */
            $table->boolean('typenm')->nullable();
            /*
                dia de descuento pronto pago
            */
            $table->integer('dayDxpp')->nullable();
            /*
                porcentaje de descuento pronto pago
            */
            $table->integer('percentDxpp')->nullable();

            $table->double('fixedamount', 10, 2)->nullable();
            $table->double('percentage', 3, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('termtypes');
    }
}
