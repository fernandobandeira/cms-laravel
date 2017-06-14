<?php

namespace App\Modules\Generico\CategoriaProduto;

use Illuminate\Database\Eloquent\Model;
use Themsaid\Transformers\AbstractTransformer;

class Transformer extends AbstractTransformer
{
    public function transformModel(Model $item)
    {
        $output = [
            'id' => $item->id,
            'ativo' => (bool) $item->ativo,
            'nome' => $item->nome,
            'slug' => $item->slug,
            'parent_id' => $item->parent_id,
            'depth' => $item->depth
        ];

        return $output;
    }
}
