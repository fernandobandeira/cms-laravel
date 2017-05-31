<?php

namespace App\Core\Http\Controllers\Traits;

use ApiHandler;
use Illuminate\Database\Eloquent\Model;

trait RestApiTrait
{
    public function index()
    {
        $this->request->merge(['_config' => 'meta-total-count,meta-filter-count']);

        $retorno = ApiHandler::parseMultiple($this->model::sorted(), $this->model::$search);

        return response()->json(
            $this->transformer::transform($retorno->getResult()),
            200,
            $retorno->getHeaders());
    }

    public function store()
    {
        $model = $this->model::create($this->request->all());
        $model->refresh();

        return response()->json($this->transformer::transform($model), 201);
    }

    public function update(Model $model) {
        if($this->request->has('ordem') && $this->request->ordem != $model->ordem) {
            $this->reorder($model, $this->request->ordem);
            $model->refresh();
        }
        $model->update($this->request->except('ordem'));
        $model->refresh();

        return response()->json($this->transformer::transform($model), 200);
    }

    public function show(Model $model) {
        return response()->json($this->transformer::transform($model), 200);
    }

    public function reorder(Model $model, $position) {
        $builder = $this->model::where('ordem', '!=', $model->ordem);

        if($model->ordem < $position) {
            $current = $builder->sorted()->where('ordem', '>=', $position)->first();
            $model->moveAfter($current);
        } else {
            $current = $builder->orderBy('ordem', 'DESC')->where('ordem', '<=', $position)->first();
            $model->moveBefore($current);
        }
    }
}