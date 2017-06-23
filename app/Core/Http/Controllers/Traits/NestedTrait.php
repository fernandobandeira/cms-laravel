<?php

namespace App\Core\Http\Controllers\Traits;

use ApiHandler;
use App\Core\Models\BaseModel;

trait NestedTrait
{
    public function formatReturn($return) {
        if ($return instanceof BaseModel) {
            $return['children'] = $return->descendants->toTree();
        } else {
            $return = $return->toTree();
        }

        return $this->transformer::transform($return);
    }

    public function applyScopes($model) {
        return $model->withDepth();
    }
}