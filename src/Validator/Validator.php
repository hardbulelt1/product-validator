<?php
/**
 * Class Validator
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */
namespace Validator\Validator;

use Validator\Product\Message\ValidatorMessage;

abstract class Validator
{
    protected $messages = [];

    /**
     * @return ValidatorMessage[]
     */
    public function getMessages(): array
    {
        return $this->messages;
    }

    /**
     * @param ValidatorMessage $productValidatorMessage
     */
    protected function addMessage(ValidatorMessage $productValidatorMessage)
    {
        $this->messages[] = $productValidatorMessage;
    }

    /**
     * @return bool
     */
    public abstract function validate(): bool;
}