<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTableMigration extends Migration
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
            $table->string('name');
            $table->integer('thickness')->nullable();
            $table->integer('width')->nullable();
            $table->integer('length')->nullable();
            $table->string('type_measure')->default('mm');
            $table->float('length_mm')->nullable();
            $table->float('PT')->nullable();
            $table->float('TOTAL_PT')->nullable();
            $table->float('m2')->nullable();
            $table->float('m3')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('product_category_id');
            $table->unsignedDecimal('purchase_price', 10, 2);
            $table->unsignedDecimal('selling_price', 10, 2);
            $table->unsignedinteger('stock')->default(0);
            $table->unsignedinteger('stock_defective')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('product_category_id')->references('id')->on('product_categories');
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
