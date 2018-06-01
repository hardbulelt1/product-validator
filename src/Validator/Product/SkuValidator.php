<?php
/**
 * Class SkuValidator
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Validator\Product;


use Validator\Message\ValidatorMessage;
use Validator\Models\Product\ProductInterface;
use Validator\Validator\Contracts\Product\ProductValidatorContract;
use Validator\Validator\Validator;
use Validator\Validator\SkuValidator as MainSkuValidator;

class SkuValidator extends Validator implements ProductValidatorContract
{

    /**
     * @param ProductInterface $product
     * @return bool
     */
    public function validate(ProductInterface $product): bool
    {
        $valid = true;
        if (count($product->getSku()) == 0) {
            $this->addMessage(new ValidatorMessage(ValidatorMessage::TYPE_ERROR, 'Нет ни одного СКУ'));
            $valid = false;
        }
        if ($this->hasValidSku($product)) {
            $this->addMessage(new ValidatorMessage(ValidatorMessage::TYPE_ERROR,
                'Нет ни одного валидного СКУ (с ценой и всеми фильтрами)'));
            $valid = false;
        }

        return $valid;
    }


    private function hasValidSku(ProductInterface $product)
    {
        foreach ($product->getSku() as $sku) {
            if((new MainSkuValidator())->validate($sku)) {
                return true;
            }
        }
        return false;
    }
}