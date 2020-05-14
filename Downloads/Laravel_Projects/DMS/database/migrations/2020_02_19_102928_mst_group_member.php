<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MstGroupMember extends Migration
{
    
    public function up()
    {
        Schema::create('mst_group_member', function(Blueprint $table){
            $table->bigIncrements('group_member_id');
            $table->integer('group_id');
            $table->integer('user_id');
            $table->integer('created_by')->length(11);
            $table->string('created_time')->length(45);
            $table->date('created_date');
            $table->integer('updated_by')->length(11);
            $table->string('updated_time')->length(45);
            $table->date('updated_date');
            $table->string('flag')->length(45)->default('Show');
        });
    }


    public function down()
    {
       Schema::dropIfExists('mst_group_member');
    }
}
