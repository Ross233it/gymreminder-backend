<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Traits\HttpResponses;

class CheckIsAdmin
{
    use HttpResponses;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::check()){
            return $this->error('','Non sei autorizzato a questa operazione', 401 );
        }
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }
        return $this->error('','Non possiedi diritti di amministrazione', 401 );
    }
}
