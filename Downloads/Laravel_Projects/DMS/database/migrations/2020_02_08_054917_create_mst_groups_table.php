<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstGroupsTable extends Migration
{
    
    public function up()
    {
        Schema::create('mst_groups', function (Blueprint $table) {
            $table->bigIncrements('group_id');
            $table->string('group_name')->length(150)->unique();
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
        Schema::dropIfExists('mst_groups');
    }
}
