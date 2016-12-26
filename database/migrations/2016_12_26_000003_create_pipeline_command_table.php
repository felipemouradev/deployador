<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePipelineCommandTable extends Migration
{
    /**
     * Run the migrations.
     * @table pipeline_command
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pipeline_command', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('commands_id')->unsigned();
            $table->integer('pipeline_id')->unsigned();


            $table->foreign('commands_id', 'fk_pipelines_commands1_idx')
                ->references('id')->on('command')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('pipeline_id', 'fk_pipeline_command_pipeline1_idx')
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
       Schema::dropIfExists('pipeline_command');
     }
}
