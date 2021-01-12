<?php

namespace App\ADR\Domain\GetGreetingOptions;

class GetGreetingOptionsResult
{
    /** @var string[] */
    private $greetings = [];

    /**
     * GetGreetingOptionsResult constructor.
     *
     * @param string[] $options
     */
    public function __construct(array $options)
    {
        $this->greetings = $options;
    }

    /**
     * @return string[]
     */
    public function getGreetings(): array
    {
        return $this->greetings;
    }
}
