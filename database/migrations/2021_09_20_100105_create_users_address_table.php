<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_address', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->string('email');
            $table->string('fname');
            $table->string('lname');
            $table->string('phone_no');
            $table->string('city');
            $table->string('barangay');
            $table->string('postal_code');
            $table->string('detailed_address');
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
        Schema::dropIfExists('users_address');
    }
}
