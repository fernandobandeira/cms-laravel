<?php

namespace App\Modules\Generico\Produto;

use \Rutorika\Sortable\SortableTrait;
use App\Core\Models\Model as BaseModel;
use Cviebrock\EloquentSluggable\Sluggable;

class Model extends BaseModel
{
    use Sluggable;
    use SortableTrait;    

    protected $table = 'produtos';    

    public static $search = [
        'nome',
        'referencia',
        'descricao'
    ];

    protected $rules = [
        'nome'  => 'required|max:150',
        'referencia' => 'max:45',
    ];

    /**
     * @Relation
     * @ManyToMany
     */
    public function categorias()
    {
        return $this->belongsToMany('App\Modules\Generico\CategoriaProduto\Model', 'categorias_produtos_produtos', 'produto_id', 'categoria_produto_id');
    }
}
