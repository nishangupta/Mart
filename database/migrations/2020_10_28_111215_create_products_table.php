<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('subCategory');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('product_code');
            $table->string('price');
            $table->string('sale_price')->nullable();
            $table->boolean('onSale')->default(0);
            $table->boolean('live')->default(1);
            $table->text('description');
            $table->smallInteger('stock');
            $table->string('brand')->default('No brand');
            $table->string('warranty')->nullable();
            $table->string('color')->nullable();
            $table->string('size')->nullable();
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
