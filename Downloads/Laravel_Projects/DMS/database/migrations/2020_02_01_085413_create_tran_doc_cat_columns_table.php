<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranDocCatColumnsTable extends Migration
{
  
    public function up()
    {
        Schema::create('tran_doc_cat_columns', function (Blueprint $table) {
            $table->bigIncrements('doc_cat_columns_id');
            $table->biginteger('doc_category_id');
            $table->string('col_caption')->length(500);
            $table->string('col_name')->length(100);
            $table->string('data_type')->length(45);
            $table->integer('data_length')->length(11);
            $table->string('data-control')->length(100);
            $table->string('mandatory_status')->length(45);
            $table->string('special_char_status')->length(45);
            $table->string('int_between_val')->length(45);
            $table->integer('min_value')->length(45);
            $table->integer('max_value')->length(45);
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
        Schema::dropIfExists('tran_doc_cat_columns');
    }
}
