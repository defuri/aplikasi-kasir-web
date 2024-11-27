<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $defUser = Auth::user();

        if (!$defUser) {
            return redirect("/")->with("error", "Silahkan login telebih dahulu");
        }

        if ($defUser->hak !== 'manager') {
            abort(403, 'Anda tidak memiliki akses menuju halaman ini');
        }

        return $next($request);
    }
}
