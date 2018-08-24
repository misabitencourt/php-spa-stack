<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Middlewares\Authentication as AuthenticationMiddleware;
use App\Middlewares\Authorization as AuthorizationMiddleware;
use App\Controllers\Generic as GenericController;
use App\Services\Sale as Service;

$service = new Service();
$controller = new GenericController($service);

$app->group('/api', function () use ($controller) {
    $this->group('/sales', function () use ($controller) {
        $this->get('/', [$controller, 'list']);
        $this->get('/{id}/', [$controller, 'find']);
        $this->post('/', function(Request $request, Response $response) {
            $service = new Service();
            $data = $request->getParsedBody();
            $data['items'] = empty($data['items']) ? null : json_decode($data['items'], true);
            $data['salesmen'] = empty($data['salesmen']) ? : json_decode($data['salesmen'], true);
            if (! empty($data['customers'])) {
                $data['customers'] = json_decode($data['customers'], true);
            }

            try {
                $resource = $service->create($data);
            } catch (\Exception $e) {
                return $response->withStatus(500)->withJson($e->getMessage());
            }

            return $response->withJson($resource);
        });
        $this->delete('/{id}/', [$controller, 'destroy']);
    })->add(new AuthenticationMiddleware());
});
