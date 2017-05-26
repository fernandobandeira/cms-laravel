<?php

namespace App\Core\Http\Controllers\Traits;

use ApiHandler;

trait RestApiTrait
{
    public function index()
    {
        $this->request->merge(['_config' => 'meta-total-count,meta-filter-count']);

        $model = new $this->model;
        $retorno = ApiHandler::parseMultiple($model, $model->search);

        return response()->json(
            $this->transformer::transform($retorno->getResult()),
            200,
            $retorno->getHeaders());
    }

    public function store()
    {
        $model = $this->model::create($this->request->except('index'));
        $model = $model->fresh();

        return response()->json($this->transformer::transform($model), 201);
    }
}