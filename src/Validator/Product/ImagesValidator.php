<?php
/**
 * Class ImagesValidator
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Validator\Product;


use Validator\Message\ValidatorMessage;
use Validator\Models\Product\ProductInterface;
use Validator\Validator\Product\Contracts\ProductValidatorContract;
use Validator\Validator\Validator;

class ImagesValidator extends Validator implements ProductValidatorContract
{

    /**
     * @param ProductInterface $product
     * @return bool
     */
    public function validate(ProductInterface $product): bool
    {
        if (!$product->isOfType(ProductInterface::TYPE_WORKSHOP_SERVICE) && (count($product->getPictures()) == 0)) {
            $this->addMessage(new ValidatorMessage(ValidatorMessage::TYPE_ERROR,
                'Нет ни однйо картинки'));
            return false;
        }
        return true;
    }
}