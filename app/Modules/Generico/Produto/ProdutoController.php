<?php

namespace App\Modules\Generico\Produto;

use App\Core\Http\Controllers\Controller;

class ProdutoController extends Controller
{
    protected $index = 'Produto';

    public function index() {
        return view('pages.datatable')
            ->with('index', $this->index);
    }
}
