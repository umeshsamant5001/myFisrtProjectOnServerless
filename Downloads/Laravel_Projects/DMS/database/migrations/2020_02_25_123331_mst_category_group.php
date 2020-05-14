<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MstCategoryGroup extends Migration
{
  
    public function up()
    {
        Schema::create('mst_category_group', function(Blueprint $table){
            $table->bigIncrements('category_group_id');
            $table->integer('doc_category_id')->length(11);
            $table->integer('group_id')->length(11);
            $table->integer('created_by')->length(11);
            $table->string('created_time')->length(45);
            $table->date('created_date');
            $table->integer('updated_by')->length(11);
            $table->string('updated_time')->length(45);
            $table->date('updated_date');
            $table->string('flag')->length(45)->default('Show');
            $table->unique(["doc_category_id", "group_id"]);
        });
    }


    public function down()
    {
        Schema::dropIfExists('mst_category_group');
    }
}
