<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblDeliveryCost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_deliveryCost', function (Blueprint $table) {
            $table->Increments('delivery_id');
            $table->Integer('delivery_matp');
            $table->Integer('delivery_maqh');
            $table->Integer('delivery_xaid');
            $table->String('delivery_cost');
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
        Schema::dropIfExists('tbl_deliveryCost');
    }
}
