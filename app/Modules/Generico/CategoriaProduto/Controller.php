<?php

namespace App\Modules\Generico\CategoriaProduto;

use App\Core\Http\Controllers\Traits\RestTrait;
use App\Core\Http\Controllers\Traits\NestedTrait;
use App\Core\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{
    use RestTrait, NestedTrait {
        NestedTrait::applyScopes insteadof RestTrait;
    }

    protected $baseView = 'modules.generico.categoriaproduto';

    protected $transformer = Transformer::class;
    protected $model = Model::class;
}
