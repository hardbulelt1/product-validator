<?php
/**
 * Class TagLineValidator
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Validator\Product;


use Validator\Message\ValidatorMessage;
use Validator\Models\Product\ProductInterface;
use Validator\Validator\Contracts\Product\ProductValidatorContract;
use Validator\Validator\Validator;

class TagLineValidator extends Validator implements ProductValidatorContract
{

    /**
     * @param ProductInterface $product
     * @return bool
     */
    public function validate(ProductInterface $product): bool
    {
        if (!$product->get_tag_line()) {
            $this->addMessage(new ValidatorMessage(ValidatorMessage::TYPE_WARNING, 'Нет тэглайна'));
            return false;
        }
        return true;
    }
}