<?php

namespace App\Modules\Generico\Produto;

use App\Core\Http\Controllers\Traits\RestTrait;
use App\Core\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{
    use RestTrait;

    protected $baseView = 'modules.generico.produto';

    protected $transformer = Transformer::class;
    protected $model = Model::class;
}
