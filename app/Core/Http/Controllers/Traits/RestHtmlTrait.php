<?php

namespace App\Core\Http\Controllers\Traits;

trait RestHtmlTrait
{
    public function index()
    {
        return view($this->baseView . '.index');
    }

    public function create()
    {
        return view($this->baseView . '.form');
    }
}