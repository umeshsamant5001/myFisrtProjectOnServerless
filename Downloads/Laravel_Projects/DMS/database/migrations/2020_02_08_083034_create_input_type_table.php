<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInputTypeTable extends Migration
{
   
    public function up()
    {
        Schema::create('input_type', function (Blueprint $table) {
            $table->bigIncrements('inpu_type_id');
            $table->string('input_type_name')->length(150);
            $table->biginteger('data_type_id')->index();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('input_type');
    }
}
