<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstRolesTable extends Migration
{
    public function up()
    {
        Schema::create('mst_roles', function (Blueprint $table) {

            $table->bigIncrements('role_id');
            $table->string('role_name')->length(150)->unique();
            $table->integer('created_by')->length(11);
            $table->date('created_date')->default(date("Y-m-d"));
            $table->string('created_time')->length(45)->default(date("H:i:s"));
            $table->integer('updated_by')->length(11);
            $table->date('updated_date')->default(date("Y-m-d"));
            $table->string('updated_time')->length(45)->default(date("H:i:s"));
            $table->string('flag')->length(45)->default('Show');
            
        });
    }	
   
    public function down()
    {
        Schema::dropIfExists('mst_roles');
    }
}
