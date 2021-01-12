<?php

namespace App\ADR\Domain\GetGreetingOptions;

class GetGreetingOptionsDomain
{
    public function process(GetGreetingOptionsPayload $payload): GetGreetingOptionsResult
    {
        return new GetGreetingOptionsResult([
            'english',
            'deutsch',
            'backwards'
        ]);
    }
}
