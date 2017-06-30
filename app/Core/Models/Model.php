<?php

namespace App\Core\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;

abstract class Model extends BaseModel
{    
    use BaseModelTrait;
    
    protected $guarded = ['created_at', 'updated_at'];
    public $incrementing = false;

    protected static $sortableField = 'ordem';
}
