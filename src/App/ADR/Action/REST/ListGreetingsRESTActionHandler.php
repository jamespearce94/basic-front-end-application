<?php

namespace App\ADR\Action\REST;

use App\ADR\Domain\GetGreetingOptions\GetGreetingOptionsDomain;
use App\ADR\Domain\GetGreetingOptions\GetGreetingOptionsPayload;
use App\ADR\Responder\REST\ListGreetingsRESTResponder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ListGreetingsRESTActionHandler implements RequestHandlerInterface
{
    /** @var GetGreetingOptionsDomain */
    private $domain;
    /** @var ListGreetingsRESTResponder */
    private $responder;

    /**
     * ListGreetingsRESTActionHandler constructor.
     *
     * @param GetGreetingOptionsDomain   $domain
     * @param ListGreetingsRESTResponder $responder
     */
    public function __construct(GetGreetingOptionsDomain $domain, ListGreetingsRESTResponder $responder)
    {
        $this->domain = $domain;
        $this->responder = $responder;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $result = $this->domain->process(new GetGreetingOptionsPayload());

        return $this->responder->respond($result);
    }
}
