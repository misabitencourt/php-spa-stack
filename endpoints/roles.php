<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Middlewares\Authentication as AuthenticationMiddleware;
use App\Middlewares\Authorization as AuthorizationMiddleware;
use App\Services\Role as RoleService;
use App\Controllers\Generic as GenericController;

$service = new RoleService();
$controller = new GenericController($service);

$app->group('/api', function () use ($controller) {
    $this->group('/roles', function () use ($controller) {
        $this->get('/', [$controller, 'list']);
        $this->get('/{id}/', [$controller, 'find']);
        $this->post('/', [$controller, 'create']);
        $this->delete('/{id}/', [$controller, 'destroy']);
        $this->put('/{id}/', [$controller, 'update']);
    })->add(new AuthenticationMiddleware())
        ->add(new AuthorizationMiddleware('roles'));
});
