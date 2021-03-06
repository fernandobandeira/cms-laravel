<?php

namespace App\Modules\Generico\Produto;

use Illuminate\Database\Eloquent\Model;
use Themsaid\Transformers\AbstractTransformer;
use App\Modules\Generico\CategoriaProduto\Transformer as CategoriaProdutoTransformer;

class Transformer extends AbstractTransformer
{
    public function transformModel(Model $item)
    {
        $output = [
            'id' => $item->id,
            'ativo' => (bool) $item->ativo,
            'disponivel' => (bool) $item->disponivel,
            'destaque' => (bool) $item->destaque,
            'nome' => $item->nome,
            'slug' => $item->slug,
            'referencia' => $item->referencia,
            'descricao' => $item->descricao,
            'ordem' => $item->ordem,
            'created_at' => $item->created_at,
        ];

        if ($this->isRelationshipLoaded($item, 'categorias')) {
            $output['categorias'] = CategoriaProdutoTransformer::transform($item->categorias);
        }

        return $output;
    }
}
