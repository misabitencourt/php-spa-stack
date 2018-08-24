<?php

namespace App\Middlewares;

use App\Services\Authorization as AuthorizationService;
use App\Helpers\Session;

class Authorization
{
    private $resource;

    public function __construct($resource)
    {
        $session = new Session();
        $role = $session->get('user.role');
        $this->authorizationEntity = new AuthorizationService($resource, $role);
    }

    public function __invoke($request, $response, $next)
    {
        if ($this->isAuthorized($request)) {
            return $next($request, $response);
        }

        return $response->withStatus(401)->withJson([
            'message' => 'Usuário sem permissão para acessar esses dados',
        ]);
    }

    private function isAuthorized($request)
    {
        if ($request->isGet()) {
            return $this->authorizationEntity->isAuthorized('read');
        }

        if ($request->isPost()) {
            return $this->authorizationEntity->isAuthorized('create');
        }

        if ($request->isPut()) {
            return $this->authorizationEntity->isAuthorized('update');
        }

        if ($request->isDelete()) {
            return $this->authorizationEntity->isAuthorized('delete');
        }

        return false;
    }
}
