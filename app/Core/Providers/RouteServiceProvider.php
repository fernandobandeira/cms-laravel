<?php

namespace App\Core\Providers;

use Schema;
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
        if (Schema::hasTable('modulos')) {
            $rotas['App\Core\Http\Controllers'] = __DIR__.'/../Http/routes.php';
            $projeto = Projeto::$tenant;

            if($projeto !== null && $projeto->modulos->first() !== null) {
                foreach ($projeto->modulos as $m) {
                    $segmento = studly_case($m->segmento);
                    $modulo = studly_case($m->modulo);
                    $base = __DIR__ . '/../../Modules/' . $segmento . '/' . $modulo . '/';
                    $namespace = 'App\Modules\\' . $segmento . '\\' . $modulo;

                    // Registra o diretório para carregar as migrations e rotas,
                    $rotas[$namespace] = $base . 'routes.php';
                }
            }

            Route::middleware('api')->group(function () use ($rotas) {
                foreach ($rotas as $namespace => $arquivo) {
                    Route::namespace($namespace)->group(
                        function () use ($arquivo) {
                            require_once $arquivo;
                        }
                    );
                }
            });
        }
    }
}
