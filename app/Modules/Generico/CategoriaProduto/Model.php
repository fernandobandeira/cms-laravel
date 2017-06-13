<?php

namespace App\Modules\Generico\CategoriaProduto;

use App\Core\Models\NestedModel;
use Cviebrock\EloquentSluggable\Sluggable;

class Model extends NestedModel
{
    use Sluggable;

    protected $table = 'categorias_produtos';

    public static $search = [
        'nome'
    ];

    protected $rules = [
        'nome'   => 'required',
    ];
}
