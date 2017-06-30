<?php

namespace App\Modules\Generico\Galeria;

use App\Core\Models\Model as BaseModel;

class Model extends BaseModel
{
    protected $table = 'galerias';

    public static $search = [
        'nome'
    ];

    protected $rules = [
        'nome'  => 'required|max:150'        
    ];

    public function scopeSorted($query)
    {
        return $query->orderBy('id');
    }

    /**
     * @Relation
     * @ManyToMany
     */
    public function categorias()
    {
        return $this->belongsToMany('App\Modules\Generico\CategoriaProduto\Model', 'categorias_produtos_produtos', 'produto_id', 'categoria_produto_id');
    }
}
