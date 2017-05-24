<?php

namespace App\Modules\Generico\Produto;

use App\Core\Http\Controllers\Controller;
use App\Core\Http\Controllers\Traits\RestTrait;

class ProdutoController extends Controller
{
    use RestTrait;

    protected $index = 'Produto';
    protected $baseView = 'modules.generico.produto';

    protected $model = Produto::class;
}
