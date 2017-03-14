<?php

namespace App\Http\Middleware;

use App\Language;
use App\Player;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class AuthenticateByDeviceId
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
        if ($device_id = $request->header('device_id')) {
            $language = Language::where('abbreviation','en')->first();
            Player::unguard();
            $player = Player::firstOrCreate(['device_id' => $device_id],
                ['device_id' => $device_id, 'nickname' => $device_id , 'language_id' => $language->id]);
            Player::reguard();
            $player = Player::findOrFail($player->id);
            Auth::login($player);
        }else{
            throw new BadRequestHttpException('you should send "device-id" in your request headers');
        }
        return $next($request);
    }
}
