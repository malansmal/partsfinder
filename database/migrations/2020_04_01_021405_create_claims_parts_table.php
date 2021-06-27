<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClaimsPartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claims_parts', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('claims_id');
            $table->string('part_description',200);
            $table->string('part_number',50)->nullable();
            $table->string('part_image',50)->nullable();
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
        Schema::dropIfExists('claims_parts');
    }
}
