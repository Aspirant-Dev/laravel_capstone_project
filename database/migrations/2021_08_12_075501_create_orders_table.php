<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->string('fname');
            $table->string('lname');
            $table->string('email');
            $table->string('address');
            $table->string('city');
            $table->string('barangay');
            $table->string('postal_code');
            $table->string('phone_no');
            $table->string('total_price');
            $table->tinyInteger('status')->default('0');
            $table->string('tracking_no');
            $table->string('payment_method');
            $table->string('payment_gateway');
            $table->string('updated_by');
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
        Schema::dropIfExists('orders');
    }
}
