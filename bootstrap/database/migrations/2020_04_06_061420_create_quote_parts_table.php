<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotePartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_parts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('quote_no',20);
            $table->string('part_number',20)->nullable();
            $table->integer('parts_id');
            $table->string('parts_type',10);
            $table->float('price');
            $table->string('parts_image',50)->nullable();
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
        Schema::dropIfExists('quote_parts');
    }
}
