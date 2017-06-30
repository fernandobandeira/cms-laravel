<?php

namespace App\Modules\Generico\Galeria;

use App\Core\Http\Controllers\Traits\RestTrait;
use App\Core\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{
    use RestTrait;

    protected $transformer = Transformer::class;
    protected $model = Model::class;
}
