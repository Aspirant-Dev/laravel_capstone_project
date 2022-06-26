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
            $table->bigIncrements('id');
            $table->bigInteger('cate_id');
            $table->string('cate_name');
            $table->string('p_code')->unique();;
            $table->string('name');
            $table->string('slug');
            $table->string('brand');
            $table->string('product_type');
            $table->longText('description');
            $table->string('price');
            $table->string('stocks');
            $table->string('critical_level');
            $table->string('unit');
            $table->string('image');
            $table->tinyInteger('status');
            $table->tinyInteger('trending');
            $table->tinyInteger('returnable');
            $table->mediumText('meta_title');
            $table->mediumText('meta_keywords');
            $table->mediumText('meta_description');
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
