<?php
/**
 * Class ProductValidatorMessage
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */
namespace Validator\Message;

class ValidatorMessage
{

    const TYPE_INFO = 'info';
    const TYPE_ERROR = 'error';
    const TYPE_WARNING = 'warning';

    private $type = '';
    private $text = '';

    public function __construct($type, $text)
    {
        $this->type = $type;
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

}