<?php

namespace App\Core\Models;

use Baum\Node;

abstract class NestedModel extends Node
{
	use BaseModelTrait;
	
    protected $guarded = ['created_at', 'updated_at', 'deleted_at'];
    public $incrementing = false;

    public function scopeSorted($query)
    {
        return $query->orderBy('lft');
    }

    /**
     * @Relation     
     */
    public function filhas()
    {
    	return $this->immediateDescendants();
    }

    /**
     * @Relation     
     */
    public function pais()
    {        
        return $this->ancestors();
    }
}
