<?php

namespace App\Core\Models;

use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    protected $connection = 'cms';

    public static $current;

    public function modulos()
    {
        return $this->belongsToMany('App\Core\Models\Modulo', 'projetos_modulos');
    }

    public static function current()
    {
    	if (static::$current == null) {
    		$subdominio = explode('.', $_SERVER['HTTP_HOST'])[0];
    		static::$current = static::whereDominio($subdominio)->with('modulos')->firstOrFail();
    	}

    	return static::$current;
    }
}
