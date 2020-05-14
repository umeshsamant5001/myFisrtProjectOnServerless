<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MstCompSetup extends Migration
{
    public function up()
    {
        Schema::create('mst_comp_setup', function(Blueprint $table){

            $table->bigIncrements('comp_id');
            $table->string('comp_name')->length(150);
            $table->biginteger('contact_no')->length(45);
            $table->string('email_id')->length(150);
            $table->string('address')->length(500)->nullable();
            $table->string('password_reset')->length(11)->nullable();
            $table->integer('after_no_of_days')->length(11)->nullable();
            $table->string('app_name')->length(45)->nullable();
            $table->string('db_name')->length(45)->nullable();
            $table->integer('created_by')->length(11);
            $table->timestamp('created_date')->useCurrent();
            $table->timestamp('created_time')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->integer('updated_by')->length(11);
            $table->timestamp('updated_date')->useCurrent();
            $table->timestamp('updated_time')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->string('flag')->length(45)->default('Show');
        });

    }

    public function down()
    {
        Schema::dropIfExists('mst_comp_setup');
    }
}
