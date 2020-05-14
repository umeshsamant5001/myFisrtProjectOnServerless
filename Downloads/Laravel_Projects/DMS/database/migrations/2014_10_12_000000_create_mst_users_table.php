<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstUsersTable extends Migration
{
   
    public function up()
    {
        Schema::create('mst_users', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->string('name')->length(150);
            $table->biginteger('contact_no')->length(45);
            $table->string('email_id')->length(150)->unique();
            $table->string('username')->length(150)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->length(150);
            $table->string('location')->length(100);
            $table->integer('designation')->length(11);
            $table->integer('role_id')->length(11);
            $table->biginteger('group_id')->length(20);
            $table->integer('created_by')->length(11);
            $table->date('created_date');
            $table->string('created_time')->length(45);
            $table->integer('updated_by')->length(11);
            $table->date('updated_date');
            $table->string('updated_time')->length(45);
            $table->string('flag')->lemgth(45)->default('Show');
        });
    }

    public function down()
    {
        Schema::dropIfExists('mst_users');
    }
}
