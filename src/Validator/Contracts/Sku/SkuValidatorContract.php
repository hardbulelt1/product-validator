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

    /**
     * @return bool
     */
    public function isRequired(): bool;

    /**
     * @param bool $required
     * @return mixed
     */
    public function setRequired(bool $required);

}