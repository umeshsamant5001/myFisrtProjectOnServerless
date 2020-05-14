<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranAuditlogsTable extends Migration
{
    
    public function up()
    {
        Schema::create('tran_auditlogs', function (Blueprint $table) {
            $table->bigIncrements('auditlog_id');
            $table->string('action')->length(250);
            $table->string('action_desc')->length(500);
            $table->integer('action_by')->length(11);
            $table->date('action_date');
            $table->string('action_time')->length(45);
        });
    }
  
    public function down()
    {
        Schema::dropIfExists('tran_auditlogs');
    }
}
