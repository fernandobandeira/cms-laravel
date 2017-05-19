<?php

namespace App\Core\Http\Middleware;

use Closure;
use Tenanti;
use App\Core\Models\Projeto;

class ChangeTenant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Tenanti::driver('projeto')->asDefaultConnection(Projeto::$tenant, 'tenants');

        return $next($request);
    }
}
