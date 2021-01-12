<?php

namespace App\ADR\Domain\GreetUser;

class GreetUserDomain
{
    public function process(GreetUserPayload $payload)
    {
        try {
            $pattern = $this->getPatternForLanguage($payload->getLanguage());
        } catch (LanguageNotFoundException $e) {
            return new UnableToGreetUserResult($payload, $e);
        }

        return new GreetUserResult(sprintf(
            $pattern,
            $payload->getName()
        ));
    }

    private function getPatternForLanguage(string $language): string
    {
        $languages = [
            'english' => 'Hello, %s',
            'deutsch' => 'Hallo, %s',
            'backwards' => '%s, Hello',
        ];
        if (!array_key_exists($language, $languages)) {
            throw LanguageNotFoundException::forLanguage($language, array_keys($languages));
        }
        return $languages[$language];
    }
}
