<?php

namespace App\Core\Http\Controllers;

use App\Core\Models\Projeto;
use App\Core\Models\Modulo;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.dashboard');
    }

    public function modulos()
    {
        $modulos = Projeto::current()->modulos;
        $modulos->map(function ($item) {
            $item->rota = route(strtolower($item->modulo . '.index'));
        });

        return $modulos;
    }

    public function projetos()
    {
        $projetos = Projeto::where('dominio', '!=', Projeto::current()->dominio)->get();
        $projetos['ativo'] = Projeto::current();

        return $projetos;
    }

    public function login()
    {
        return view('pages.login');
    }
}
