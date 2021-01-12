<?php

namespace App\ADR\Responder\REST;

use App\ADR\Domain\GetGreetingOptions\GetGreetingOptionsResult;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\JsonResponse;

class ListGreetingsRESTResponder
{
    public function respond(GetGreetingOptionsResult $result): ResponseInterface
    {
        return new JsonResponse(
            [
                'status' => 'success',
                'data' => [
                    'greetings' => $result->getGreetings(),
                ],
            ]
        );
    }
}
