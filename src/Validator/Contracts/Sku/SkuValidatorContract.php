<?php
/**
 * Class SkuValidatorContract
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Validator\Contracts\Sku;


use Validator\Models\Sku\SkuInterface;

interface SkuValidatorContract
{
    /**
     * @param SkuInterface $sku
     * @return bool
     */
    public function validate(SkuInterface $sku): bool;

    /**
     * @return array
     */
    public function getMessages(): array;

}