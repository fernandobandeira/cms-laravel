<?php

namespace App\Core\Providers;

use App;
use File;
use Schema;
use Storage;
use Artisan;
use App\Core\Models\Projeto;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Core\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        // Verifica se a migration da tabela modulos já rodou para registrar
        // as rotas e migrations específicas para cada módulo da aplicação
        if (!App::runningInConsole() && Schema::hasTable('modulos')) {
            $caminho = 'routes/'.Projeto::current()->dominio.'.php';

            if (App::environment('production') && Storage::exists($caminho)) {
                require storage_path('app/'.$caminho);
                return;
            }

            Artisan::call('tenanti:route', [ 'entity' => Projeto::current()->id ]);

            require storage_path('app/'.$caminho);
        }
    }
}
