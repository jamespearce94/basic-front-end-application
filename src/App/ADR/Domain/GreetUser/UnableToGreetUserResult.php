<?php

namespace App\ADR\Domain\GreetUser;

class UnableToGreetUserResult implements GreetUserResultInterface
{
    /* @var GreetUserPayload */
    private $payload;
    /** @var GreetUserExceptionInterface */
    private $exception;

    public function __construct(GreetUserPayload $payload, GreetUserExceptionInterface $exception)
    {
        $this->payload = $payload;
        $this->exception = $exception;
    }

    public function getPayload(): GreetUserPayload
    {
        return $this->payload;
    }

    public function getException(): GreetUserExceptionInterface
    {
        return $this->exception;
    }
}
