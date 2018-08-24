<?php

namespace App\Middlewares;

use App\Services\Authentication as AuthenticationService;

class Authentication
{
    public function __construct()
    {
    }

    public function __invoke($request, $response, $next)
    {
        $auth = new AuthenticationService();

        if ($auth->isAuthenticated()) {
            return $next($request, $response);
        }

        return $response->withStatus(401)->withJson([
            'message' => 'Usuário não autenticado',
        ]);
    }
}
