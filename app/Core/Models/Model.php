<?php

namespace App\Core\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    public static $search = [];
    protected $guarded = ['id'];
}
