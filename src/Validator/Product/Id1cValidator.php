<?php
/**
 * Class Id1cValidator
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Validator\Product;


use Validator\Message\ValidatorMessage;
use Validator\Models\Product\ProductInterface;
use Validator\Validator\ContractsProduct\ProductValidatorContract;
use Validator\Validator\Validator;

class Id1cValidator extends Validator implements ProductValidatorContract
{

    /**
     * @param ProductInterface $product
     * @return bool
     */
    public function validate(ProductInterface $product): bool
    {
        if (!$product->getId1c()) {
            $this->addMessage(new ValidatorMessage(ValidatorMessage::TYPE_ERROR, 'Не указан ID 1C'));
            return false;
        }
        return true;
    }
}