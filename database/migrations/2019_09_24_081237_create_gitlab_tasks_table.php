<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGitlabTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gitlab_tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('tardis_id');
            $table->unsignedInteger('gitlab_id');
            $table->unsignedInteger('gitlab_iid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gitlab_tasks');
    }
}
