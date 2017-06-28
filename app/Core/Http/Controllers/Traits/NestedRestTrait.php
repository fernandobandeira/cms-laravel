<?php

namespace App\Core\Http\Controllers\Traits;

use Baum\MoveNotPossibleException;
use Illuminate\Database\Eloquent\Model;

trait NestedRestTrait
{
    use RestTrait;

    public function reorder(Model $model, $position)
    {
    	try {
	        if ($position == 'sobe') {
	        	$model->moveLeft();
	        } else if ($position == 'desce') {
	        	$model->moveRight();
	        }
    	} catch(MoveNotPossibleException $e) {
    		
    	}
    }

    public function reorderQuery(Model $model) { }
}
