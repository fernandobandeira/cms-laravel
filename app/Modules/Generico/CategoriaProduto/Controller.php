<?php

namespace App\Modules\Generico\CategoriaProduto;

use App\Core\Http\Controllers\Traits\NestedRestTrait;
use App\Core\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{
    use NestedRestTrait;

    protected $transformer = Transformer::class;
    protected $model = Model::class;
}
