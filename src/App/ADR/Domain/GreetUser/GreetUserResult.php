<?php

namespace App\ADR\Domain\GreetUser;

class GreetUserResult implements GreetUserResultInterface
{
    /** @var string */
    private $greeting;

    public function __construct(string $greeting)
    {
        $this->greeting = $greeting;
    }

    public function getGreeting()
    {
        return $this->greeting;
    }
}
