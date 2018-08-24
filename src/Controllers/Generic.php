<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Exceptions\NotFoundException;
use App\Exceptions\InvalidException;

class Generic
{
    private $service;

    public function __construct($service)
    {
        $this->service = $service;
    }

    public function list(Request $request, Response $response): Response
    {
        try {
            $search = $request->getQueryParam('search');

            $resources = $this->service->list($search);
            return $response->withJson($resources);
        } catch(NotFoundException $e) {
            return $response->withJson([
                'message' => 'Não foi possível encontrar os registros',
            ])->withStatus(404);
        } catch(InvalidException $e) {
            return $response->withJson([
                'message' => $e->getMessage(),
            ])->withStatus(400);
        } catch(Exception $e) {
            return $response->withJson([
                'message' => $e->getMessage(),
            ])->withStatus(500);
        }
    }

    public function find(Request $request, Response $response): Response
    {
        try {
            $id = $request->getAttribute('id');

            $resource = $this->service->find((int) $id);
            return $response->withJson($resource);
        } catch(NotFoundException $e) {
            return $response->withJson([
                'message' => 'Não foi possível encontrar o registro',
            ])->withStatus(404);
        } catch(InvalidException $e) {
            return $response->withJson([
                'message' => $e->getMessage(),
            ])->withStatus(400);
        } catch(Exception $e) {
            return $response->withJson([
                'message' => $e->getMessage(),
            ])->withStatus(500);
        }
    }

    public function destroy(Request $request, Response $response): Response
    {
        try {
            $id = $request->getAttribute('id');

            $this->service->destroy((int) $id);
            return $response->withJson([
                'message' => 'Registro apagado com sucesso'
            ]);
        } catch(NotFoundException $e) {
            return $response->withJson([
                'message' => 'Não foi possível encontrar o registro',
            ])->withStatus(404);
        } catch(InvalidException $e) {
            return $response->withJson([
                'message' => $e->getMessage(),
            ])->withStatus(400);
        } catch(Exception $e) {
            return $response->withJson([
                'message' => 'Não foi possível apagar o registro',
            ])->withStatus(500);
        }

    }

    public function update(Request $request, Response $response): Response
    {
        try {
            $data = $request->getBody();
            $data = json_decode($data, true);
            $id = $request->getAttribute('id');

            $resource = $this->service->update((int) $id, $data);
            return $response->withJson($resource);
        } catch(NotFoundException $e) {
            return $response->withJson([
                'message' => 'Não foi possível encontrar o registro',
            ])->withStatus(404);
        } catch(InvalidException $e) {
            return $response->withJson([
                'message' => $e->getMessage(),
            ])->withStatus(400);
        } catch(Exception $e) {
            return $response->withJson([
                'message' => 'Não foi possível atualizar o registro',
            ])->withStatus(500);
        }
    }

    public function create(Request $request, Response $response): Response
    {
        try {
            $data = $request->getParsedBody();

            $resource = $this->service->create($data);
            return $response->withJson($resource);
        } catch(InvalidException $e) {
            return $response->withStatus(400)->write($e->getMessage());
        } catch(Exception $e) {
            return $response->withStatus(500)->write($e->getMessage());
        }
    }
}
