<?php

namespace App\Core\Http\Controllers\Traits;

trait RestHtmlTrait
{
    public function index()
    {
        return view($this->baseView.'.index')
            ->with('index', $this->index);
    }
}