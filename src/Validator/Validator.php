<?php
/**
 * Class Validator
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */
namespace Validator\Validator;



use Validator\Message\ValidatorMessage;

abstract class Validator
{
    protected $messages = [];
    protected $required = true;

    /**
     * @return bool
     */
    public function isRequired(): bool
    {
        return $this->required;
    }

    /**
     * @param bool $required
     */
    public function setRequired(bool $required)
    {
        $this->required = $required;
    }

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
}