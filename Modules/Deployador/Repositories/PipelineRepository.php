<?php

namespace Modules\Deployador\Repositories;

use Modules\Deployador\Entities\Pipeline;
use Illuminate\Support\Facades\DB;

class PipelineRepository
{
    
    //retorna id(number) ou array caso algo de errado
    public function store($data,$exeception = null){
        $message = null;
        $model = new Pipeline();
        $validate = $model->validate($data,$exeception);
        if(is_array($validate)) return $validate;
        try {
            DB::beginTransaction();
            $data = $model->create($data);
            DB::commit();
            return $data->id;
        } catch(\Exception $e) {
            DB::rollback();
            return ['message'=>$e->getMessage()];
        }
    }

    //retorna id(number) ou array caso algo de errado
    public function update($id,$data,$exeception = null){
        $message = null;
        $model = new Pipeline();
        $validate = $model->validate($data,$exeception);
        if(is_array($validate)) return $validate;
        try {
            DB::beginTransaction();
            $data = $model->where('id',$id)->update($data);
            DB::commit();
            return true;
        } catch(\Exception $e) {
            DB::rollback();
            return ['message'=>$e->getMessage()];
        }
    }

    //retorna true ou array caso algo de errado
    public function delete($id){
        $message = null;
        $model = new Pipeline();
        if(is_null($id)) return ['message'=>'id não pode ser nulo'];
        try {
            DB::beginTransaction();
            $data = $model->where('id',$id)->delete($id);
            DB::commit();
            return true;
        } catch(\Exception $e) {
            DB::rollback();
            return ['message'=>$e->getMessage()];
        }
    }

    //retorna o builder de um model
    public function builder()
    {
        $model = new Pipeline();
        return $model;
    }
}