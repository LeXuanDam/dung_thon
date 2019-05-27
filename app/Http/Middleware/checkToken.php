<?php

namespace App\Http\Middleware;

use Closure;
use App\Helper\JsonWebToken as JWT;
use App\Services\ResponseService;
use App\Models\User;
class checkToken
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
        $response = new ResponseService();
        $token = JWT::getToken();
        if($token) {
            $token = JWT::decode($token);
            if ($token->time < time()) {
                return $response->json(false, 'Invalid token');
            }
            $user = User::find($token->id);
            if (!$user) {
                return $response->json(false, 'Invalid token');
            }
            return $next($request);
        }
        return $response->json(false, 'Invalid token');
    }
}
