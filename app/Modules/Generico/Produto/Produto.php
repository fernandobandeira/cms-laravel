<?php

namespace App\Modules\Generico\Produto;

use App\Core\Models\Model;
use \Rutorika\Sortable\SortableTrait;

class Produto extends Model
{
    use SortableTrait;

    protected static $sortableField = 'ordem';

    public static $search = [
        'nome',
        'referencia',
        'descricao'
    ];
}
