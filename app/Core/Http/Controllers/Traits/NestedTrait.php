<?php

namespace App\Core\Http\Controllers\Traits;

trait NestedTrait
{
    public function applyScopes($model) {
        return $model->withDepth();
    }
}