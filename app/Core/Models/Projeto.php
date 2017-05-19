<?php

namespace App\Core\Models;

use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    protected $connection = 'cms';

    public static $tenant;

    public function modulos() {
        return $this->belongsToMany('App\Core\Models\Modulo', 'projetos_modulos');
    }
}
