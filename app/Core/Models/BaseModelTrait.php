<?php

namespace App\Core\Models;

use Uuid;
use Watson\Validating\ValidatingTrait;

trait BaseModelTrait
{
    use ValidatingTrait;

    protected $throwValidationExceptions = true;    
    public static $search = [];
    protected $rules;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'nome'
            ]
        ];
    }

    public static function bootBaseModelTrait() {
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

    public static function getMTMRelations()
    {
        $relations = [];
        $reflextionClass = new \ReflectionClass(get_called_class());

        foreach($reflextionClass->getMethods() as $method)
        {
            $doc = $method->getDocComment();

            if($doc && strpos($doc, '@ManyToMany') !== false)
            {
                $relations[] = $method->getName();
            }
        }

        return $relations;
    }
}
