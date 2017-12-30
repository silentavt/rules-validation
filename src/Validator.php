<?php

namespace Silentavt\Validation;


use Silentavt\Validation\ValidationRules\ValidationRuleInterface;

class Validator
{
    /** @var ValidationRuleInterface[] */
    protected $validationRules = [];

    /**
     * Adds a rule to validationRules array
     *
     * @param ValidationRuleInterface $validationRule
     */
    public function addValidationRule(ValidationRuleInterface $validationRule)
    {
        $this->validationRules[get_class($validationRule)] = $validationRule;
    }

    /**
     * Removes a rule from validationRules array
     *
     * @param ValidationRuleInterface|string $validationRule
     */
    public function removeValidationRule($validationRule)
    {
        if ($validationRule instanceof ValidationRuleInterface) {
            $validationRule = get_class($validationRule);
        }

        if (isset($this->validationRules[$validationRule])) {
            unset($this->validationRules[$validationRule]);
        }
    }

    /**
     * Removes all validation rules from the validationArray
     */
    public function clearValidationRules()
    {
        $this->validationRules = [];
    }

    /**
     * Validates a value using validationRules array
     *
     * @param string $value
     * @return bool
     * @throws ValidationExceptions\ValidationException
     */
    public function isValidValue(string $value)
    {
        $isValid = true;

        foreach ($this->validationRules as $validationRule) {
            if (! $validationRule->isValid($value)) {
                $isValid = false;

                $exception = $validationRule->getException();
                if ($exception !== null) {

                    throw $exception;
                }
            }
        }

        return $isValid;
    }
}