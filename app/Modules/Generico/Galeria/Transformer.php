<?php

namespace App\Modules\Generico\Galeria;

use Illuminate\Database\Eloquent\Model;
use Themsaid\Transformers\AbstractTransformer;

class Transformer extends AbstractTransformer
{
    public function transformModel(Model $item)
    {
        $output = [
            'id' => $item->id,
            'nome' => $item->nome,
            'modulo' => $item->modulo->nome,
        ];

        return $output;
    }
}
