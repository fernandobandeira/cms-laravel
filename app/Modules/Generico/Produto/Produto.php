<?php

namespace App\Modules\Generico\Produto;

use App\Core\Models\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Produto extends Model
{
    use Sluggable;

    public static $search = [
        'nome',
        'referencia',
        'descricao'
    ];

    protected $rules = [
        'nome'   => 'required',
    ];
}
