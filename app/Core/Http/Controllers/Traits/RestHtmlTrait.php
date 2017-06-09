<?php

namespace App\Core\Http\Controllers\Traits;

use Illuminate\Database\Eloquent\Model;

trait RestHtmlTrait
{
    public function index()
    {
        return view('pages.component')
            ->with('component', $this->getComponentName().'-index');
    }

    public function create()
    {
        return view('pages.component')
            ->with('component', $this->getComponentName().'-form');
    }

    public function edit(Model $model) {
        return view('pages.component')
            ->with('component', $this->getComponentName().'-form');
    }

    public function getComponentName() {
        $namespace = debug_backtrace();
        $namespace = $namespace[1]['class'];
        $namespace = explode('\\', $namespace);
        $namespace = array_slice($namespace, -3, 2, true);
        $namespace = implode('-', $namespace);
        return strtolower($namespace);
    }
}