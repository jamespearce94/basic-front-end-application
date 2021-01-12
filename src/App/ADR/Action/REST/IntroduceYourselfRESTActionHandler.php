<?php

namespace App\ADR\Action\REST;

use App\ADR\Domain\GreetUser\GreetUserDomain;
use App\ADR\Domain\GreetUser\GreetUserPayload;
use App\ADR\Domain\GreetUser\NotReadyToGreetUserResult;
use App\ADR\Responder\REST\IntroduceYourselfRESTResponder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class IntroduceYourselfRESTActionHandler implements RequestHandlerInterface
{
    /** @var GreetUserDomain */
    private $domain;
    /** @var IntroduceYourselfRESTResponder */
    private $responder;

    public function __construct(GreetUserDomain $domain, IntroduceYourselfRESTResponder $responder)
    {
        $this->domain = $domain;
        $this->responder = $responder;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        switch ($request->getMethod()) {
            case 'GET':
                return $this->get($request);
                break;
            case 'POST':
                return $this->post($request);
                break;
            case 'PATCH':
                return $this->patch($request);
                break;
            case 'DELETE':
                return $this->delete($request);
                break;
            default:
                return $this->methodNotSupported($request->getMethod());
        }
    }

    private function get(ServerRequestInterface $request)
    {
        $queryParams = $request->getQueryParams();

        if (false == isset($queryParams['name']) || false == isset($queryParams['language'])) {
            return $this->responder->respond(new NotReadyToGreetUserResult());
        }

        $result = $this->domain->process(
            new GreetUserPayload(
                $queryParams['name'],
                $queryParams['language']
            )
        );

        return $this->responder->respond($result);
    }

    private function methodNotSupported(string $method)
    {
        return new JsonResponse(
            [
                'status' => 'error',
                'message' => 'Method not supported: ' . $method,
            ]
        );
    }

    private function post(ServerRequestInterface $request)
    {
        return $this->methodNotSupported($request->getMethod());
    }

    private function patch(ServerRequestInterface $request)
    {
        return $this->methodNotSupported($request->getMethod());
    }

    private function delete(ServerRequestInterface $request)
    {
        return $this->methodNotSupported($request->getMethod());
    }
}
