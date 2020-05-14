<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstDocCategoriesTable extends Migration
{
  
    public function up()
    {
        Schema::create('mst_doc_category', function (Blueprint $table) {
            $table->bigIncrements('doc_category_id');
            $table->string('doc_category_caption')->length(250)->unique();
            $table->string('doc_category_name')->length(250)->unique(); 
            $table->string('doc_category_desc')->length(500); 
            $table->string('doc_category_type')->length(45);
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
        Schema::dropIfExists('mst_doc_category');
    }
}
