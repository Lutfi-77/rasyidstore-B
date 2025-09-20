<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variant', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id');
            $table->foreignId('prod_attr_id')->nullable();
            $table->integer('stock');
            $table->integer('price');
            $table->tinyInteger('is_ready');

            $table->foreign('product_id')->on('products')->references('id')->cascadeOnDelete();

            $table->foreign('prod_attr_id')->on('attributes')->references('id')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_variant');
    }
};
