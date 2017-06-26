<?php

namespace App\Core\Models;

use \Rutorika\Sortable\SortableTrait;
use Illuminate\Database\Eloquent\Model as BaseModel;

abstract class Model extends BaseModel
{
    use SortableTrait;
    use BaseModelTrait;

    protected $observables = ['validating'];
    protected $guarded = ['created_at', 'updated_at', 'deleted_at'];
    public $incrementing = false;

    protected static $sortableField = 'ordem';

    public static function boot() {
    	self::bootBaseModelTrait();
        self::bootSortableTrait();

        parent::boot();
    }
}
