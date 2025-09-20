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
        Schema::create('order', function (Blueprint $table) {
            $table->id();

            $table->foreignId('prod_variant_id');
            $table->foreignId('user_id')->nullable();
            $table->integer('quantity');
            $table->foreignId('transaction_id')->nullable();

            $table->foreign('user_id')->on('users')->references('id')->nullOnDelete();

            $table->foreign('transaction_id')->on('transaction')->references('id')->nullOnDelete();
            $table->foreign('prod_variant_id')->on('product_variant')->references('id')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
};
