<?php
/**
 * Class SkuInterface
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */
namespace Validator\Sku;

use Validator\Feature\FeatureInterface;
use Validator\Product\ProductInterface;

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

    /**
     * @return mixed
     */
    public function getPriceCurrent();

    /**
     * @return ProductInterface
     */
    public function getProduct();

    public function setValid(bool $valid);

    public function getTotalStock();

    public function getPriceOld();

    /**
     * @param $key
     * @return FeatureInterface
     */
    public function getFeature($key);
}