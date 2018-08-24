<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Middlewares\Authentication as AuthenticationMiddleware;
use App\Middlewares\Authorization as AuthorizationMiddleware;
use App\Repositories\Resource as ResourceRepository;

$app->group('/api', function () {
    $this->group('/resources', function () {
        $this->get('/', function (Request $request, Response $response) {
            try {
                $search = $request->getQueryParam('search');

                $resourceRepository = new ResourceRepository();
                $resources = $resourceRepository->list($search);
                return $response->withJson($resources);
            } catch(Exception $e) {
                dd($e->getMessage());
                return $response->withJson([
                    'message' => 'Não foi possível encontrar os recursos',
                ])->withStatus(500);
            }
        });
    })->add(new AuthenticationMiddleware());
});
