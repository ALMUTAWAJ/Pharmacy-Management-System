<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StaffOrCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        $routeId = $request->route()->parameter('id');
    
        if ($user->role === 'staff' || $user->role === 'customer') {
            if ($user->id != $routeId) {
                $request->route()->setParameter('id', $user->id);
            }
            return $next($request);
        }
    
        // if not customer or staff
        return redirect(route('home')); 
    }
    
}
