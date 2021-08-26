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
            $table->string('category_product')->default('Producto Terminado');
            $table->string('name');
            $table->float('thickness',8,3)->nullable();
            $table->float('width',8,3)->nullable();
            $table->float('length',8,3)->nullable();
            $table->string('type_measure')->default('M2');
            $table->float('length_mm')->nullable();
            $table->float('PT')->nullable();
            $table->float('TOTAL_PT')->nullable();
            $table->float('m2',8,5)->nullable();
            $table->float('m3',8,5)->nullable();
            $table->float('pulg',8,5)->nullable();
            $table->float('m2_total',8,5)->nullable();
            $table->float('m3_total',8,5)->nullable();
            $table->float('pulg_total',8,5)->nullable();
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
