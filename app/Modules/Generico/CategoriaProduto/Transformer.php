<?php

namespace App\Modules\Generico\CategoriaProduto;

use Illuminate\Database\Eloquent\Model;
use Themsaid\Transformers\AbstractTransformer;

class Transformer extends AbstractTransformer
{
    public function transformModel(Model $item)
    {
        $output = [
            'id' => $item->uuid,
            'ativo' => (bool) $item->ativo,
            'nome' => $item->nome,
            'slug' => $item->slug
        ];

        return $output;
    }
}
