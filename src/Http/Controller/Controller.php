<?php
namespace Budgetcontrol\Authentication\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Controller {

    public function monitor()
    {
        return response([
            'success' => true,
            'message' => 'Authentication service is up and running'
        ]);
    }
}