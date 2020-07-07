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
            $table->foreignId('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->
                    onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreignId('tariff_id');
            $table->foreign('tariff_id')->references('id')->on('tariffs')->
                    onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->string('address', 150);
            $table->date('delivery_date');

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
