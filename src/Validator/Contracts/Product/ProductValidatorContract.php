<?php
/**
 * Class ProductValidatorContract
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */
namespace Validator\Validator\ContractsProduct;

use Validator\Message\ValidatorMessage;
use Validator\Models\Product\ProductInterface;

interface ProductValidatorContract
{
    /**
     * @param ProductInterface $product
     * @return bool
     */
    public function validate(ProductInterface $product): bool;

    /**
     * @return ValidatorMessage[]
     */
    public function getMessages(): array;

}