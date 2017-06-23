<?php

namespace App\Core\Http\Controllers\Traits;

use DB;
use ApiHandler;
use Illuminate\Database\Eloquent\Model;

trait RestApiTrait
{
    public function index()
    {
        $this->request->merge(['_config' => 'meta-total-count,meta-filter-count']);

        $model = $this->request->has('_sort') ? new $this->model : $this->model::sorted();
        $model = $this->applyScopes($model);

        $retorno = ApiHandler::parseMultiple($model, $this->model::$search);

        return response()->json(
            $this->formatReturn($retorno->getResult()),
            200,
            $retorno->getHeaders());
    }

    public function store()
    {
        $model = $this->model::create($this->request->all());
        $model = $this->refresh($model);

        return response()->json($this->formatReturn($model), 201);
    }

    public function update(Model $model) {
        if($this->request->has('ordem') && $this->request->ordem != $model->ordem) {
            $this->reorder($model, $this->request->ordem);
            $model->refresh();
        }
        $model->update($this->request->except('ordem'));
        $model = $this->refresh($model);

        return response()->json($this->formatReturn($model), 200);
    }

    public function show(Model $model) {
        $model = $this->refresh($model);

        return response()->json($this->formatReturn($model), 200);
    }

    public function destroy(Model $model) {
        $model->delete();
        $this->reorderQuery($model);

        return response()->json('', 204);
    }

    public function reorder(Model $model, $position) {
        $query = $this->model::where('ordem', '!=', $model->ordem);
        $builder = clone $query;

        $method = $model->ordem < $position ? 'moveAfter' : 'moveBefore';
        $this->{$method}($model, $position, $query, $builder);
    }

    public function moveAfter(Model $model, $position, $query, $builder) {
        $current = $builder->sorted()->where('ordem', '>=', $position)->first();
        if($current == null) {
            $current = $query->orderBy('ordem', 'DESC')->first();
        }
        $model->moveAfter($current);
    }

    public function moveBefore(Model $model, $position, $query, $builder) {
        $current = $builder->orderBy('ordem', 'DESC')->where('ordem', '<=', $position)->first();
        if($current == null) {
            $current = $query->sorted()->first();
            $this->reorderQuery($model);
        }
        $model->moveBefore($current);
    }

    public function reorderQuery(Model $model) {
        return DB::unprepared('SET @cont := 0; update '.$model->getTable().' set ordem = @cont := @cont + 1 order by ordem;');
    }

    public function applyScopes($model) {
        return $model;
    }

    public function formatReturn($return) {
        return $this->transformer::transform($return);
    }

    public function refresh($model) {
        $model = $this->model::whereKey($model->getKey());
        return $this->applyScopes($model)->first();
    }
}