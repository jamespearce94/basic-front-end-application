<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class LanguageToLowerCaseMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $queryParams = $request->getQueryParams();
        if (true == isset($queryParams['language'])) {
            $queryParams['language'] = strtolower($queryParams['language']);
            $request = $request->withQueryParams($queryParams);
        }

        return $handler->handle($request);
    }
}
