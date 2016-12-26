<?php
/**
 * Created by PhpStorm.
 * User: felipemoura
 * Date: 24/12/2016
 * Time: 23:11
 */

namespace Modules\Deployador\Http\Controllers;
use Illuminate\Routing\Controller;

class SSH2Controller extends Controller
{
    protected $connection;
    protected $project;

    public function __construct($project)
    {
        $this->project = $project;
        $this->connection = ssh2_connect($this->project->server->host, 22);
        ssh2_auth_password($this->connection , $this->project->server->login, $this->project->server->password);
    }

    public function sshExec($command)
    {
        try {
            $stream = ssh2_exec($this->connection,$command);
            stream_set_blocking($stream, true);
            $errorStream = ssh2_fetch_stream($stream, SSH2_STREAM_STDERR);
            $return = stream_get_contents($errorStream);
            fclose($stream);
            return $return;
        } catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function execPipeline($pipeline)
    {
        $return = [];
        foreach ($pipeline->PipelineCommand as $command)
        {
            $return[] = $this->sshExec($command->command->command);
        }
        return $return;
    }
}