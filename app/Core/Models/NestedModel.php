<?php

namespace App\Core\Models;

use Kalnoy\Nestedset\NodeTrait;

abstract class NestedModel extends BaseModel
{
    use NodeTrait;

    public function scopeSorted($query) {
        return $query->defaultOrder();
    }

    public static function boot() {
        self::bootNodeTrait();

        parent::boot();
    }
}
