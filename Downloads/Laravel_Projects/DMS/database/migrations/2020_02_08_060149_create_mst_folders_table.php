<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstFoldersTable extends Migration
{
   
    public function up()
    {
        Schema::create('mst_folders', function (Blueprint $table) {
            $table->bigIncrements('folder_id');
            $table->biginteger('cabinet_id')->index();
            $table->string('folder_name')->length(150)->unique();
            $table->string('folder_desc')->length(500);
            $table->integer('folder_size')->length(11);
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
        Schema::dropIfExists('mst_folders');
    }
}
