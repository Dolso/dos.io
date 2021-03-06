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
            $table->timestamps();
            $table->string('city', 100)->nullable();
            $table->integer('id_creator')->nullable();
            $table->integer('id_accepted')->nullable();
            $table->string('name', 100)->nullable();
            $table->string('address', 200)->nullable();
            $table->text('products')->nullable();
            $table->tinyInteger('status')->default(0); // 0 - не принят, 1 - принят, 2 - выполнен
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
