<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstDesignationsTable extends Migration
{
    
    public function up()
    {
        Schema::create('mst_designations', function (Blueprint $table) {
            $table->bigIncrements('designation_id');
            $table->string('designation');
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
        Schema::dropIfExists('mst_designations');
    }
}
