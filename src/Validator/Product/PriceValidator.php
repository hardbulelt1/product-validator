<?php
/**
 * Class PriceValidator
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Validator\Product;


use Validator\Message\ValidatorMessage;
use Validator\Models\Product\ProductInterface;
use Validator\Validator\Product\Contracts\ProductValidatorContract;
use Validator\Validator\Validator;

class PriceValidator extends Validator implements ProductValidatorContract
{

    /**
     * @param ProductInterface $product
     * @return bool
     */
    public function validate(ProductInterface $product): bool
    {
        if ($product->getPriceCurrent() == 0 && !$product->getPriceVariable()) {
            $this->addMessage(new ValidatorMessage(ValidatorMessage::TYPE_ERROR, 'Нет цены'));
            return false;
        }
        return true;
    }
}
