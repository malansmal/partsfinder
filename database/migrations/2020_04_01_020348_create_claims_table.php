<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claims', function (Blueprint $table) {
            $table->increments('id');
            $table->string('claim_no', 15);
            $table->string('client_name', 50);
            $table->string('contact_no', 20);
            $table->string('client_email', 50);
            $table->integer('make_id' );
            $table->string('make_model', 100);
            $table->string('vin', 50)->nullable();
            $table->integer('year' );
            $table->timestamp('received_date');
            $table->integer('area_id' );
            $table->string('reference_cn',50 )->nullable();
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
        Schema::dropIfExists('claims');
    }
}
