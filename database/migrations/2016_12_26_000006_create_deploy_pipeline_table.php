<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeployPipelineTable extends Migration
{
    /**
     * Run the migrations.
     * @table deploy_pipeline
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deploy_pipeline', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->dateTime('date_deploy')->nullable();
            $table->string('file_output_deploy', 255)->nullable();
            $table->integer('deploy_id')->unsigned();
            $table->integer('pipeline_id')->unsigned();


            $table->foreign('deploy_id', 'fk_deploy_pipeline_deploy1_idx')
                ->references('id')->on('deploy')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('pipeline_id', 'fk_deploy_pipeline_pipeline1_idx')
                ->references('id')->on('pipeline')
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
       Schema::dropIfExists('deploy_pipeline');
     }
}
