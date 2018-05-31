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
    public function getValue(): ?string;

    /**
     * @return bool|null
     */
    public function getIsForProduct(): bool;

    /**
     * @return bool
     */
    public function getIsForSku(): bool;

    /**
     * @param $key
     * @return String
     */
    public function getData($key): ?string;

    /**
     * @return null|string
     */
    public function getFeatureCode(): ?string;

    /**
     * @return mixed
     */
    public function getValues();
}