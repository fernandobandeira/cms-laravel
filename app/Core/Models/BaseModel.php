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
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

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
            if($model->uuid === null) {
                $model->uuid = Uuid::generate(4);
            }
        });
    }
}
