<?php

namespace App\Core\Models;

use Uuid;
use Watson\Validating\ValidatingTrait;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    use ValidatingTrait;

    protected $throwValidationExceptions = true;
    protected $observables = ['validating'];
    public static $search = [];
    protected $rules;
    protected $guarded = ['created_at', 'updated_at', 'deleted_at'];
    public $incrementing = false;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'nome'
            ]
        ];
    }

    public static function boot() {
        self::bootValidatingTrait();

        $uses = class_uses(new static);

        if (isset($uses['Cviebrock\EloquentSluggable\Sluggable'])) {
            self::bootSluggable();
        }

        self::creating(function($model) {
            if($model->id === null) { //TODO Checar se UUID é válido
                $model->id = Uuid::generate(4);
            }
        });
    }
}
