<?php

namespace App\ADR\Action\Web;

use App\ADR\Domain\GreetUser\GreetUserDomain;
use App\ADR\Domain\GreetUser\GreetUserPayload;
use App\ADR\Domain\GreetUser\NotReadyToGreetUserResult;
use App\ADR\Responder\Web\IntroduceYourselfWebResponder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class IntroduceYourselfWebActionHandler implements RequestHandlerInterface
{
    /** @var GreetUserDomain */
    private $domain;
    /** @var IntroduceYourselfWebResponder */
    private $responder;

    public function __construct(GreetUserDomain $domain, IntroduceYourselfWebResponder $responder)
    {
        $this->domain = $domain;
        $this->responder = $responder;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryParams = $request->getQueryParams();

        if ($request->getAttribute('single-page', false)) {
            return $this->responder->respond(
                new NotReadyToGreetUserResult(),
                ['single-page' => true]
            );
        }

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
}
