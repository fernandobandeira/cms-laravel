<?php

namespace App\Core\Console\Commands;

use File;
use Storage;
use App\Core\Models\Projeto;
use Illuminate\Console\Command;

class RouteCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenanti:route {entity?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates the routes for all tenants.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $projetos = is_null($this->argument('entity')) ? Projeto::All() : [Projeto::findOrFail($this->argument('entity'))];

        foreach($projetos as $projeto) {
            $rotas = [];
            $caminho = 'routes/'.$projeto->dominio.'.php';
            $rotas['App\Core\Http\Controllers'] = app_path('Core/Http/routes.php');

            if ($projeto->modulos->first() !== null) {
                $modulos = $projeto->modulos;
                foreach ($modulos as $m) {
                    $segmento = studly_case($m->segmento);
                    $modulo = studly_case($m->modulo);
                    $base = app_path('Modules/' . $segmento . '/' . $modulo . '/');
                    $namespace = 'App\Modules\\' . $segmento . '\\' . $modulo;

                    // Registra o diretório para carregar as migrations e rotas,
                    $rotas[$namespace] = $base . 'routes.php';
                }
            }

            $rotasCompiladas = '<?php';
            $rotasCompiladas .= PHP_EOL;
            $rotasCompiladas .= 'Route::middleware(\'api\')->group(function () {';

            foreach ($rotas as $namespace => $arquivo) {
                $rotasCompiladas .= 'Route::namespace(\''.$namespace.'\')->group(function () {';
                $rotasCompiladas .= str_replace('<?php', '', File::get($arquivo));
                $rotasCompiladas .= '});';
            }

            $rotasCompiladas .= '});';

            Storage::disk('local')->put($caminho, $rotasCompiladas);
        }
    }
}
