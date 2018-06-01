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
        $is_validate = true;
        $skuFactory = new SkuValidatorFactory();
        $skuFactory->make();
        foreach ($skuFactory->getValidators() as $validator) {
            if ($validator->validate($sku) === false) {
                $is_validate = false;
            }
            foreach ($validator->getMessages() as $message) {
                $this->addMessage($message);
            }
        }

        return $is_validate;
    }
}