<?php

namespace App\ADR\Domain\GreetUser;

use OutOfBoundsException;

class LanguageNotFoundException extends OutOfBoundsException implements GreetUserExceptionInterface
{
    /** @var string */
    private $language;
    /** @var string[] */
    private $validOptions;

    public static function forLanguage(string $language, array $validOptions): self
    {
        $message = sprintf(
            'Language "%s" not found in language list. Valid options are %s',
            $language,
            join(', ', $validOptions)
        );

        $exception = new self($message);
        $exception->setLanguage($language);
        $exception->setValidOptions($validOptions);

        return $exception;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    private function setLanguage(string $language): void
    {
        $this->language = $language;
    }

    /**
     * @return string[]
     */
    public function getValidOptions(): array
    {
        return $this->validOptions;
    }

    /**
     * @param string[] $validOptions
     */
    private function setValidOptions(array $validOptions): void
    {
        $this->validOptions = $validOptions;
    }
}
