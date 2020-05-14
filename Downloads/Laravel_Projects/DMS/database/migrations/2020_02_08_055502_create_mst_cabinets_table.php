<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstCabinetsTable extends Migration
{

    public function up()
    {
        Schema::create('mst_cabinets', function (Blueprint $table) {
            $table->bigIncrements('cabinet_id');
            $table->string('cabinet_name')->length(150)->unique();
            $table->integer('cabinet_size')->length(11);
            $table->string('cabinet_description')->length(500);
            $table->integer('created_by')->length(11);
            $table->date('created_date');
            $table->string('created_time')->length(45);
            $table->integer('updated_by')->length(11);
            $table->date('updated_date');
            $table->string('updated_time')->length(45);
            $table->string('flag')->length(45)->default('Show');
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('mst_cabinets');
    }
}
