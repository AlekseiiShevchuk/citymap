<?php

namespace App\Http\Middleware;

use App\Player;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class UpdateOnlinePlayersStorage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Cache::put('citymap.players:' . Auth::id(), Player::find(Auth::id()), 5);

        return $next($request);
    }
}
