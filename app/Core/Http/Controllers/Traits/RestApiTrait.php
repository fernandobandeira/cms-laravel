<?php

namespace App\Core\Http\Controllers\Traits;

use DB;
use ApiHandler;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

trait RestApiTrait
{
    public function list()
    {
        $this->request->merge(['_config' => 'meta-total-count,meta-filter-count']);

        $model = $this->request->has('_sort') ? new $this->model : $this->model::sorted();

        $retorno = ApiHandler::parseMultiple($model, $this->model::$search);

        return $this->formatReturn($retorno->getResult(), 200, $retorno->getHeaders());
    }

    public function store()
    {
        $return = $this->saveRelationships(new $this->model, 'create');

        return $this->formatReturn($return, 201);
    }

    public function update(Model $model)
    {
        if($this->request->has('ordem') && $this->request->ordem != $model->ordem) {
            $this->reorder($model, $this->request->ordem);
            unset($this->request['ordem']);
            $model->refresh();
        }

        $return = $this->saveRelationships($model, 'update');

        return $this->formatReturn($return, 200);
    }

    public function destroy(Model $model)
    {
        $model->delete();
        $this->reorderQuery($model);

        return $this->formatReturn('', 204);        
    }

    public function reorder(Model $model, $position)
    {
        $query = $this->model::where('ordem', '!=', $model->ordem);
        $builder = clone $query;

        $method = $model->ordem < $position ? 'moveAfter' : 'moveBefore';
        $this->{$method}($model, $position, $query, $builder);
    }

    public function moveAfter(Model $model, $position, $query, $builder)
    {
        $current = $builder->sorted()->where('ordem', '>=', $position)->first();
        if($current == null) {
            $current = $query->orderBy('ordem', 'DESC')->first();
        }
        $model->moveAfter($current);
    }

    public function moveBefore(Model $model, $position, $query, $builder)
    {
        $current = $builder->orderBy('ordem', 'DESC')->where('ordem', '<=', $position)->first();
        if($current == null) {
            $current = $query->sorted()->first();
            $this->reorderQuery($model);
        }
        $model->moveBefore($current);
    }

    public function reorderQuery(Model $model)
    {
        return DB::unprepared('SET @cont := 0; update '.$model->getTable().' set ordem = @cont := @cont + 1 order by ordem;');
    }

    public function saveRelationships(Model $model, $method)
    {
        $relationships = $this->model::getMTMRelations();

        $data = $this->request->except($relationships);
        if (isset($data[0])) {
            $model->{$method}($this->request->except($data));
        }

        foreach($relationships as $relationship) {
            if($this->request->has($relationship)) {
                $model->{$relationship}()->sync($this->request->{$relationship});
            }
        }

        $model->refresh();

        return $model;
    }

    public function formatReturn($return, $status = 200, $headers = [])
    {
        if($return instanceof Model || $return instanceof Collection) {
            $return = $this->transformer::transform($return);
        }

        return response()->json($return, $status, $headers);
    }
}
