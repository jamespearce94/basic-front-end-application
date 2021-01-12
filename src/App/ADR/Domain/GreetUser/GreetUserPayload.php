<?php

namespace App\ADR\Domain\GreetUser;

class GreetUserPayload
{
    /** @var string */
    private $name;
    /** @var string */
    private $language;

    public function __construct(string $name, string $language)
    {
        $this->name = $name;
        $this->language = $language;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }
}
