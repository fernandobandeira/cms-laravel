<?php

namespace App\Core\Models;

use \Rutorika\Sortable\SortableTrait;

abstract class Model extends BaseModel
{
    use SortableTrait;

    protected static $sortableField = 'ordem';

    public static function boot() {
        self::bootSortableTrait();

        parent::boot();
    }
}
