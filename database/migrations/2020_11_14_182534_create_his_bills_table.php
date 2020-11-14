<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHisBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('his_bills', function (Blueprint $table) {
            $table->id('his_bill_id');
            $table->unsignedBigInteger('invoicenumber_id');
            $table->unsignedBigInteger('ink_id');
            $table->double('ink_cost',250);
            $table->double('ink_profit',250);
            $table->integer('ink_amount');
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
        Schema::dropIfExists('his_bills');
    }
}
