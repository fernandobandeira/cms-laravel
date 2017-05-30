<?php

namespace App\Core\Providers;

use App;
use View;
use Tenanti;
use Illuminate\Http\Request;
use App\Core\Models\Projeto;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        if (!App::runningInConsole()) {
            $subdominio = explode('.', $_SERVER['HTTP_HOST'])[0];
            Projeto::$tenant = Projeto::whereDominio($subdominio)->firstOrFail();
        }

        Tenanti::connection('tenants', function (Projeto $entity, array $config, $database, $factory) {
            if (App::runningInConsole()) {
                $this->mapMigrations($entity, $factory);
            }

            $config['database'] = $entity->dominio;

            return $config;
        });
    }

    public function mapMigrations($entity, $factory)
    {
        if ($entity->modulos->first() !== null) {
            foreach ($entity->modulos as $m) {
                $segmento = studly_case($m->segmento);
                $modulo = studly_case($m->modulo);
                $base = __DIR__ . '/../../Modules/' . $segmento . '/' . $modulo . '/';

                // Registra o diretório para carregar as migrations,
                $factory->loadMigrationsFrom($base . 'Migrations', $entity);
            }
        }
    }
}
