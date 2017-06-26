<?php

namespace App\Modules\Generico\CategoriaProduto;

use Illuminate\Database\Eloquent\Model;
use Themsaid\Transformers\AbstractTransformer;
use App\Modules\Generico\Produto\Transformer as ProdutoTransformer;

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
            'depth' => $item->depth,
        ];

        $relations = array_keys($item->relationsToArray());

        if ($this->isRelationshipLoaded($item, 'filhas')) {
            $output['filhas'] = static::transform($item->filhas()->with($relations)->get());
        }

        if ($this->isRelationshipLoaded($item, 'produtos')) {
            $output['produtos'] = ProdutoTransformer::transform($item->produtos);
        }

        return $output;
    }
}
