<?php

namespace App\Modules\Generico\Produto;

use App\Core\Models\Model as BaseModel;
use Cviebrock\EloquentSluggable\Sluggable;

class Model extends BaseModel
{
    use Sluggable;

    protected $table = 'produtos';

    public static $search = [
        'nome',
        'referencia',
        'descricao'
    ];

    protected $rules = [
        'nome'   => 'required',
    ];

    /**
     * @Relation
     * @ManyToMany
     */
    public function categorias() {
        return $this->belongsToMany('App\Modules\Generico\CategoriaProduto\Model', 'categorias_produtos_produtos', 'produto_id', 'categoria_produto_id');
    }
}
