<?php
/**
 * Class SkuValidator
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Validator;
use Validator\Models\Sku\SkuInterface;
use Validator\Validator\Contracts\Sku\SkuValidatorContract;
use Validator\Validator\Factory\SkuValidatorFactory;


class SkuValidator extends Validator implements SkuValidatorContract
{
    /**
     * @param SkuInterface $sku
     * @return bool
     */
    public function validate(SkuInterface $sku): bool
    {
        $isValid = true;
        $skuFactory = new SkuValidatorFactory();
        $skuFactory->make();
        foreach ($skuFactory->getValidators() as $validator) {
            if ($validator->validate($sku) === false && ($validator->isRequired())) {
                $isValid = false;
            }
            foreach ($validator->getMessages() as $message) {
                $this->addMessage($message);
            }
        }

        return $isValid;
    }
}