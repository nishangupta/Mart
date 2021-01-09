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
            $table->string('title');
            $table->text('description');
            $table->string('slug')->unique();
            $table->string('product_code');
            $table->string('price');
            $table->string('discount')->nullable();
            $table->string('brand')->default('No brand');
            $table->string('warranty')->nullable();
            $table->boolean('status')->default(1);
            $table->unsignedBigInteger('subCategory_id')->nullable();
            $table->foreign('subCategory_id')->references('id')->on('categories')->nullOnDelete();
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
