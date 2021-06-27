<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('claim_id');
            $table->string('quote_no',20);
            $table->string('supplier_quote_no',20)->nullable();
            $table->string('name',50);
            $table->bigInteger('supplier_id');
            $table->string('contact_no',20);
            $table->string('address',100);
            $table->string('area_name',100);
            $table->string('email',50);
            $table->enum('vat_vendor', array('Yes','No'))->default('No');
            $table->date('quote_date');
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
        Schema::dropIfExists('quotes');
    }
}
