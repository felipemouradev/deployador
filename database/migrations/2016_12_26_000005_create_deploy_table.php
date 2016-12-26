<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeployTable extends Migration
{
    /**
     * Run the migrations.
     * @table deploy
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deploy', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('deploy_name', 255)->nullable();
            $table->string('deploy_internal_name', 255)->nullable();
            $table->integer('project_id')->unsigned();


            $table->foreign('project_id', 'fk_deploy_project1_idx')
                ->references('id')->on('project')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists('deploy');
     }
}
