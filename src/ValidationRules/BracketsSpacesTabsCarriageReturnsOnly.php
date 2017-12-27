<?php

namespace Silentavt\Validation\ValidationRules;


use Silentavt\Validation\ValidationExceptions\InvalidArgumentException;
use Silentavt\Validation\ValidationExceptions\ValidationException;

class BracketsSpacesTabsCarriageReturnsOnly implements ValidationRuleInterface
{

    /**
     * Validates provided value and returns a boolean true if the value is valid or boolean false otherwise
     *
     * @param string $value
     *
     * @return bool
     */
    public function isValid(string $value): bool
    {
        $validChars = [
            '(',
            ')',
            ' ',
            "\t",
            "\n",
            "\r",
        ];

        foreach ($validChars as $validChar) {
            $value = str_replace($validChar, '', $value);
        }

        return $value === '';
    }

    /**
     * Returns ValidationException that will be thrown by Validator if provided value is invalid
     * (exception will NOT be thrown if this method will return null)
     *
     * @return ValidationException|null
     */
    public function getException(): ? ValidationException
    {
        return new InvalidArgumentException();
    }
}