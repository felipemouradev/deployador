<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePipelineTable extends Migration
{
    /**
     * Run the migrations.
     * @table pipeline
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pipeline', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 45)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists('pipeline');
     }
}
