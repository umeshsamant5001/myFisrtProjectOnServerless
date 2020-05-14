<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTypeTable extends Migration
{
    
    public function up()
    {
        Schema::create('data_type', function (Blueprint $table) {
            $table->bigIncrements('data_type_id');
            $table->string('data_type')->length(150);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('data_type');
    }
}
