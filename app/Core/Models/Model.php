<?php

namespace App\Core\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    public $search = [];
    protected $guarded = ['id'];
}
