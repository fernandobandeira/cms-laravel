<?php

namespace App\Core\Http\Controllers;

use App\Core\Models\Projeto;
use App\Core\Models\Modulo;

class DashboardController extends Controller
{
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

    public function clientes() {
        $clientes =  Projeto::All();

        return $clientes;
    }

    public function login() {
        return view('pages.login');
    }
}
