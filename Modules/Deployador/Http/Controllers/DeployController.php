<?php

namespace Modules\Deployador\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Deployador\Entities\Deploy;
use Modules\Deployador\Entities\DeployPipeline;
use Modules\Deployador\Entities\Pipeline;
use Modules\Deployador\Entities\PipelineCommand;
use Modules\Deployador\Entities\Project;
use Modules\Deployador\Repositories\DeployRepository;

class DeployController extends Controller
{

    public function getProject($project_id) {
        $builderProject = Project::find($project_id)->with('server');
        $project = $builderProject->first();
        return ($project);
    }

    public function deployApp($project_id,$deploy_id)
    {
        try {
            $project = $this->getProject($project_id);
            $builderPipeline = Pipeline::with(['PipelineCommand'=>function($query){
                $query->with('Command');
            }])->where('deploy_id',$deploy_id);
            $pipeline = $builderPipeline->first();
            $execSSH2 = (new SSH2Controller($project))->execPipeline($pipeline);

            DeployPipeline::create([
                'date_deploy'=>date('Y-m-d H:i:s'),
                'file_output_deploy'=>json_encode($execSSH2),
                'deploy_id'=>$deploy_id,
                'pipeline_id'=>$pipeline->id
            ]);
            return $execSSH2;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    //retorna item paginados
    public function index()
    {
        $repository = new DeployRepository;
        return $repository->builder()->paginate();
    }
    //metodo para salvar um novo registro
    public function store(Request $request)
    {
        $data = $request->all();
        $repository = new DeployRepository;
        $save = $repository->store($data);
        //testa se o respositorio retorna um erro
        if(is_array($save)) return response()->json($save,400);
        return response()->json(['message'=>'Salvo com sucesso'],200);
    }
    //atualiza um registro
    public function update(Request $request,$id)
    {
        $data = $request->all();
        $repository = new DeployRepository;
        $update = $repository->update($id,$data);
        //testa se o respositorio retorna um erro
        if(is_array($update)) return response()->json($update,400);
        return response()->json(['message'=>'Atualizado com sucesso'],200);
    }
    //destruir um item
    public function destroy($id)
    {
        $repository = new DeployRepository;
        $destroy = $repository->delete($id);
        if(is_array($destroy)) return $destroy;
        return response()->json(['message'=>'Deletado com sucesso'],400);
    }

}