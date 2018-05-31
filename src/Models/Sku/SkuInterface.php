<?php
/**
 * Class SkuInterface
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */
namespace Validator\Models\Sku;

use Validator\Models\Feature\FeatureInterface;
use Validator\Models\Product\ProductInterface;

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
     * @return int|null
     */
    public function getPriceCurrent(): ?int;

    /**
     * @return ProductInterface
     */
    public function getProduct();

    /**
     * @param bool $valid
     * @return void
     */
    public function setValid(bool $valid);

    /**
     * @return int|null
     */
    public function getTotalStock(): ?int;

    /**
     * @return int|null
     */
    public function getPriceOld(): ?int;

    /**
     * @param $key
     * @return FeatureInterface
     */
    public function getFeature($key);

    /**
     * @return int|null
     */
    public function getColorId(): ?int;

    /**
     * @return int|null
     */
    public function getStatureMin(): ?int;

    /**
     * @param $value
     * @return void
     */
    public function setStatureMin($value);

    /**
     * @return int|null
     */
    public function getStatureMax(): ?int;

    /**
     * @param $value
     * @return int|null
     */
    public function setStatureMax($value): ?int;



}