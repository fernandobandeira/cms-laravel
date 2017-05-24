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
    public function boot()
    {
        if (! App::runningInConsole()) {
            Projeto::$tenant = Projeto::find(1);
        }

        Tenanti::connection('tenants', function (Projeto $entity, array $config, $database, $factory) {
            Projeto::$tenant = $entity;

            $this->mapMigrations($entity, $factory);

            $config['database'] = $entity->dominio;

            return $config;
        });
    }

    public function mapMigrations($entity, $factory) {
        $modulos = $entity->modulos;
        if($modulos->first() !== null) {
            foreach ($modulos as $m) {
                $segmento = studly_case($m->segmento);
                $modulo = studly_case($m->modulo);
                $base = __DIR__.'/../../Modules/'.$segmento.'/'.$modulo.'/';

                // Registra o diretório para carregar as migrations,
                $factory->loadMigrationsFrom($base.'Migrations', $entity);
            }
        }
    }
}
