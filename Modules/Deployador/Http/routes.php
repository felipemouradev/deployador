<?php

Route::group(['middleware' => 'web', 'prefix' => 'deployador', 'namespace' => 'Modules\Deployador\Http\Controllers'], function()
{

    Route::get('/', function(){
        return view('deployador::index');
    });
    //Rotas para server
    Route::get('/server', 'ServerController@index');
    Route::post('/server/store', 'ServerController@store');
    Route::post('/server/update/{id}','ServerController@update');
    Route::get('/server/destroy/{id}','ServerController@destroy');

    
    //Rotas para command
    Route::get('/command', 'CommandController@index');
    Route::post('/command/store', 'CommandController@store');
    Route::post('/command/update/{id}','CommandController@update');
    Route::get('/command/destroy/{id}','CommandController@destroy');

    
    //Rotas para pipeline
    Route::get('/pipeline', 'PipelineController@index');
    Route::post('/pipeline/store', 'PipelineController@store');
    Route::post('/pipeline/update/{id}','PipelineController@update');
    Route::get('/pipeline/destroy/{id}','PipelineController@destroy');

    
    //Rotas para project
    Route::get('/project', 'ProjectController@index');
    Route::post('/project/store', 'ProjectController@store');
    Route::post('/project/update/{id}','ProjectController@update');
    Route::get('/project/destroy/{id}','ProjectController@destroy');

    
    //Rotas para pipeline_command
    Route::get('/pipeline_command', 'PipelineCommandController@index');
    Route::post('/pipeline_command/store', 'PipelineCommandController@store');
    Route::post('/pipeline_command/update/{id}','PipelineCommandController@update');
    Route::get('/pipeline_command/destroy/{id}','PipelineCommandController@destroy');

    
    //Rotas para deploy
    Route::get('/deploy', 'DeployController@index');
    Route::get('/deploy/app/{project}/{deploy}', 'DeployController@deployApp');
    Route::post('/deploy/store', 'DeployController@store');
    Route::post('/deploy/update/{id}','DeployController@update');
    Route::get('/deploy/destroy/{id}','DeployController@destroy');

    
    //Rotas para deploy_pipeline
    Route::get('/deploy_pipeline', 'DeployPipelineController@index');
    Route::post('/deploy_pipeline/store', 'DeployPipelineController@store');
    Route::post('/deploy_pipeline/update/{id}','DeployPipelineController@update');
    Route::get('/deploy_pipeline/destroy/{id}','DeployPipelineController@destroy');

    //[CODE]
});
