<?php

namespace App\Modules\Generico\Produto;

use App\Core\Http\Controllers\Controller;
use App\Core\Http\Controllers\Traits\RestTrait;

class ProdutoController extends Controller
{
    use RestTrait;

    protected $baseView = 'modules.generico.produto';

    protected $transformer = ProdutoTransformer::class;
    protected $model = Produto::class;
}
