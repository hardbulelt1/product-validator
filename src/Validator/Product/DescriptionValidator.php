<?php
/**
 * Class DescriptionValidator
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Validator\Product;


use Validator\Message\ValidatorMessage;
use Validator\Models\Product\ProductInterface;
use Validator\Validator\Contracts\Product\ProductValidatorContract;
use Validator\Validator\Validator;

class DescriptionValidator extends Validator implements ProductValidatorContract
{

    /**
     * @param ProductInterface $product
     * @return bool
     */
    public function validate(ProductInterface $product): bool
    {
        if (!$product->get_description()) {
            $this->addMessage(new ValidatorMessage(ValidatorMessage::TYPE_WARNING, 'Нет описания'));
            return false;
        }
        return true;
    }
}