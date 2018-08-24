<?php

use App\Services\Authentication as AuthenticationService;
use App\Exceptions\UnauthorizedException;
use App\Exceptions\NotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->group('/api', function () {
    $this->post('/login/', function (Request $request, Response $response) {
        try {
            $data = $request->getParsedBody();
            $auth = new AuthenticationService();
            $userData = $auth->login($data['email'], $data['password']);

            return $response->withJson($userData);
        } catch(UnauthorizedException $e) {
            return $response->withJson([
                'message' => 'Login ou senha inválidos'
            ])->withStatus(401);
        } catch(NotFoundException $e) {
            return $response->withJson([
                'message' => 'Login ou senha inválidos'
            ])->withStatus(401);
        } catch (Exception $e) {
            dd($e);
            return $response->withJson([
                'message' => 'Algo aconteceu de errado, tente novamente mais tarde'
            ])->withStatus(500);
        }
    });

    $this->get('/logoff/', function (Request $request, Response $response) {
        $auth = new AuthenticationService();
        $auth->logoff();

        return $response->withStatus(302)->withHeader('Location', '/');
    });
});

