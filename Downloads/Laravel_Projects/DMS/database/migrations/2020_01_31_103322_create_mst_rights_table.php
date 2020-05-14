<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstRightsTable extends Migration
{
   
    public function up()
    {
        Schema::create('mst_rights', function (Blueprint $table) {

            $table->bigIncrements('rights_id')->length(11);
            $table->integer('doc_category_limit')->length(11)->unique()->nullable();
            $table->integer('workflow_limit')->length(11)->unique()->nullable();
            $table->integer('cabinet_limit')->length(11)->unique()->nullable();
            $table->integer('folders_limit')->length(11)->unique()->nullable();
            $table->integer('folder_structure_level')->length(11)->unique()->nullable();
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
        Schema::dropIfExists('mst_rights');
    }
}
