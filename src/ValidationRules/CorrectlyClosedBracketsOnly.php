<?php

namespace Silentavt\Validation\ValidationRules;


use Silentavt\Validation\ValidationExceptions\ValidationException;

class CorrectlyClosedBracketsOnly implements ValidationRuleInterface
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
        $pattern = '~\([ \t\r\n]*\)~Us';
        $matchCount = 0;

        do {
            $value = trim(preg_replace($pattern, '', $value, $limit = -1, $matchCount));
        } while ($matchCount > 0);

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
        return null;
    }
}