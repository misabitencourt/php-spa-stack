<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Middlewares\Authentication as AuthenticationMiddleware;
use App\Repositories\Permission as PermissionRepository;

$app->group('/api', function () {
    $this->group('/permissions', function () {
        $this->get('/', function (Request $request, Response $response) {
            try {
                $permissionRepository = new PermissionRepository();
                $permissions = $permissionRepository->listByCurrentUser();
                return $response->withJson($permissions);
            } catch(Exception $e) {
                return $response->withJson([
                    'message' => 'Não foi possível encontrar as permissões',
                ])->withStatus(500);
            }
        });
    })->add(new AuthenticationMiddleware());
});
