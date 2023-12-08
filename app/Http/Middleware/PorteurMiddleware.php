<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PorteurMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if (auth()->check()) {
        //     $role = auth()->user()->role;
        //     // dd($role); 
        //     if ($role === "Porteur") {
        //         return $next($request);
        //     }
        // }
    
        // return response()->json(["error" => "Accès non autorisé"], 403);


        if(auth()->check() && auth()->user()->role==="Porteur"){
            return $next($request);
        }

        return response()->json(["error" => "Accès non autorisé"],403);
       
    }
}
