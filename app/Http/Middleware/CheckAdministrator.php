<?php

namespace App\Http\Middleware;

use App\Models\UserStore;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdministrator
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, \Closure $next): Response
    {
        $user = auth()->user();
        $store = session('store');

        if ($store) {
            $userStore = UserStore::where('user_id', $user->id)->where('store_rut', $store->rut)->where('role_id', 2)->orWhere('role_id', 3)->first();
            if (auth()->check() && $userStore) {
                return $next($request);
            } else {
                return redirect('dashboard');
            }
        } else {
            return redirect('stores');
        }
    }
}
