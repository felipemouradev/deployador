<?php

namespace Modules\Deployador\Entities;

use Illuminate\Database\Eloquent\Model;

class Deploy extends Model
{
    protected $table='deploy';
    protected $primaryKey='id';
    protected $fillable=['id','deploy_name','deploy_internal_name','project_id'];
    public $timestamps = false;

    

    public function Project()
    {
        return $this->belongsTo('\Modules\Deployador\Entities\Project');
    }

    
    public function validate($data,$execeptions)
    {
        //para não validar nenhum campo basta passar "*" como execeptions
        if($execeptions=="*") return true;
        $fillable = $this->fillable;
        unset($fillable[0]);
        sort($fillable);
        $message = [];

        for($i=0;$i<count($fillable);$i++){
            if($execeptions != null && in_array($fillable[$i],$execeptions)){
               continue;
            }
            if(!isset($data[$fillable[$i]])){
                 $message[] = "preencha o campo ".$fillable[$i];
            } elseif($data[$fillable[$i]]==""){
                $message[] = "o campo ".$fillable[$i]." está nulo";
            }
        }
        if(empty($message)) return true;
        return ['message'=>$message];
    }
}
