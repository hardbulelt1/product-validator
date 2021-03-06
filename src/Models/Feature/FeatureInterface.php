<?php
/**
 * Class FeatureInterface
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */
namespace Validator\Models\Feature;

interface FeatureInterface
{
    /**
     * @return String
     */
    public function getValue();

    /**
     * @return bool|null
     */
    public function getIsForProduct(): bool;

    /**
     * @return bool
     */
    public function getIsForSku(): bool;
}