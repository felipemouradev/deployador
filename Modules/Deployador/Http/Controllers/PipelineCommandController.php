<?php

namespace Modules\Deployador\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Deployador\Repositories\PipelineCommandRepository;

class PipelineCommandController extends Controller
{
    
    //retorna item paginados
    public function index()
    {
        $repository = new PipelineCommandRepository;
        return $repository->builder()->paginate();
    }
    //metodo para salvar um novo registro
    public function store(Request $request)
    {
        $data = $request->all();
        $repository = new PipelineCommandRepository;
        $save = $repository->store($data);
        //testa se o respositorio retorna um erro
        if(is_array($save)) return response()->json($save,400);
        return response()->json(['message'=>'Salvo com sucesso'],200);
    }
    //atualiza um registro
    public function update(Request $request,$id)
    {
        $data = $request->all();
        $repository = new PipelineCommandRepository;
        $update = $repository->update($id,$data);
        //testa se o respositorio retorna um erro
        if(is_array($update)) return response()->json($update,400);
        return response()->json(['message'=>'Atualizado com sucesso'],200);
    }
    //destruir um item
    public function destroy($id)
    {
        $repository = new PipelineCommandRepository;
        $destroy = $repository->delete($id);
        if(is_array($destroy)) return $destroy;
        return response()->json(['message'=>'Deletado com sucesso'],400);
    }

}