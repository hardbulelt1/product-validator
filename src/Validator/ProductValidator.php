<?php
/**
 * Class ProductValidator
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */
namespace Validator\Validator;
use Validator\Models\Product\ProductInterface;
use Validator\Validator\ContractsProduct\ProductValidatorContract;
use Validator\Validator\Factory\ProductValidatorFactory;


class ProductValidator extends Validator implements ProductValidatorContract
{


    /**
     * @param ProductInterface $product
     * @return bool
     */
    public function validate(ProductInterface $product): bool
    {
        $is_validate = true;
        $productFactory = new ProductValidatorFactory();
        $productFactory->make();
        foreach ($productFactory->getValidators() as $validator) {
            if ($validator->validate($product) === false) {
                $is_validate = false;
            }
            foreach ($validator->getMessages() as $message) {
                $this->addMessage($message);
            }
        }

        return $is_validate;
    }
}