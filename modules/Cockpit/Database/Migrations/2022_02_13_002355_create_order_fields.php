<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('orders')){
            Schema::table('orders', function (Blueprint $table) {
                $table->string('pickup_address')->nullable();
                $table->string('pickup_lat')->nullable();
                $table->string('pickup_lng')->nullable();

                $table->string('delivery_lat')->nullable();
                $table->string('delivery_lng')->nullable();
                $table->string('delivery_address')->nullable();
                $table->float('distance',8,2)->default(0);

                $table->unsignedBigInteger('restorant_id')->nullable(true)->change();
            });
            
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
            
    }
}
