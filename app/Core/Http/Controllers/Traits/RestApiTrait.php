<?php

namespace App\Core\Http\Controllers\Traits;

trait RestApiTrait
{
    public function index()
    {
        return $this->model::All();
    }
}