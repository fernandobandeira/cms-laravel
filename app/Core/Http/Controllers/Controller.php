<?php

namespace App\Core\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $index = '';
    protected $retorno = [];
    protected $status = 200;
    protected $request;

    public function __construct(Request $request)
    {
        $request->merge(['index' => $this->index]);
        $this->request = $request;
    }

    protected function callMethod() {
        $trace = debug_backtrace();
        $caller = $trace[1];

        if(isset($caller['function'])) {
            $suffix = $this->request->wantsJson() ? 'Api' : 'Html';
            $function = $caller['function'].$suffix;

            return $this->{$function}();
        }
    }
}
