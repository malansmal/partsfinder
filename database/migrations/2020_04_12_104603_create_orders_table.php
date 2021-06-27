<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->bigInteger('claim_id');
            $table->string('order_no',20);
            $table->string('buyer_order_no',20);
            $table->string('name',50);
            $table->string('contact_no',20);
            $table->string('address',255);
            $table->string('email',50);
            $table->string('quoted_ids',50);
            $table->timestamp('received_date');
            $table->enum('status', array('Pending','Bought', 'Completed'))->default('Pending');
            //$table->timestamps();
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
