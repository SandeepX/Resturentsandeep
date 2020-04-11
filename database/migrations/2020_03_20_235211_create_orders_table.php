<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->date('ordered_date');
            $table->string('item');
            $table->Integer('qty');
            $table->float('cost')->nullable();
            $table->float('rate');
            $table->unsignedBigInteger('ordered_by')->nullable();
            $table->enum('status',['pending','completed','cancelled'])->default('pending');
            $table->foreign('ordered_by')->references('id')->on('users')->onDelete('SET NULL');
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
