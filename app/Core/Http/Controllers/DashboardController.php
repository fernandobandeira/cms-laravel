<?php

namespace App\Core\Http\Controllers;

use App\Core\Models\Projeto;
use App\Core\Models\Modulo;

class DashboardController extends Controller
{
    protected $index = 'Dashboard';

    public function index() {
        return view('pages.dashboard');
    }

    public function modulos() {
        $modulos =  Modulo::All();
        $modulos->map(function($item) {
            $item->rota = route(strtolower($item->modulo.'.index'));
        });

        return $modulos;
    }

    public function projetos() {
        $projetos =  Projeto::All();

        return $projetos;
    }

    public function login() {
        return view('pages.login');
    }
}
