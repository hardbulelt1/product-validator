<?php
/**
 * Class SkuInterface
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */
namespace Validator\Sku\Interfaces;

interface SkuInterface
{
    /**
     * @param $feature
     * @return bool
     */
    public function hasFeature($feature): bool;

    /**
     * @return bool
     */
    public function isValid(): bool;
}