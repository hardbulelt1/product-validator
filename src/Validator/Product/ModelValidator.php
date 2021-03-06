<?php
/**
 * Class ModelValidator
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Validator\Product;


use Validator\Message\ValidatorMessage;
use Validator\Models\Product\ProductInterface;
use Validator\Validator\Contracts\Product\ProductValidatorContract;
use Validator\Validator\Validator;

class ModelValidator extends Validator implements ProductValidatorContract
{

    /**
     * @param ProductInterface $product
     * @return bool
     */
    public function validate(ProductInterface $product): bool
    {
        if (!$product->getModel()) {
            $this->addMessage(new ValidatorMessage(ValidatorMessage::TYPE_ERROR, 'Нет названия модели'));
            return false;
        }
        return true;
    }
}