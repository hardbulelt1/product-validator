<?php
/**
 * Class PriceValidator
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Validator\Sku;


use Validator\Message\ValidatorMessage;
use Validator\Models\Sku\SkuInterface;
use Validator\Validator\Contracts\Sku\SkuValidatorContract;
use Validator\Validator\Validator;

class PriceValidator extends Validator implements SkuValidatorContract
{

    /**
     * @param SkuInterface $sku
     * @return bool
     */
    public function validate(SkuInterface $sku): bool
    {
        if ($sku->getPriceCurrent() == 0 && $sku->getProduct()->getPriceVariable() == false) {
            $this->addMessage(new ValidatorMessage(ValidatorMessage::TYPE_ERROR, 'Некорректная цена'));
            return false;
        }

        return true;
    }
}