<?php
/**
 * Class ProductInterface
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Models\Product;

use Validator\Models\Category\CategoryInterface;
use Validator\Models\Feature\FeatureInterface;
use Validator\Models\Brand\BrandInterface;
use Validator\Models\Feature\ProductFeature;
use Validator\Models\Feature\ProductFeatureInterface;
use Validator\Models\Sku\SkuInterface;

interface ProductInterface
{
    const TYPE = 'products';
    const TYPE_BIKE = 'bike';
    const TYPE_KICK_SCOOTER = 'kickScooter';
    const TYPE_ACCESSORY = 'accessory';
    const TYPE_SPARE_PART = 'spare_part';
    const TYPE_WORKSHOP_SERVICE = 'workshop_service';
    const TYPE_GIFT_CARD = 'gift_card';
    const TYPE_OTHER = 'other';

    /**
     * @return SkuInterface[]|null
     */
    public function getSku();

    /**
     * @return null|String
     */
    public function getCode(): ?String;

    /**
     * @return null|String
     */
    public function getModel(): ?String;

    /**
     * @return mixed
     */
    public function getPictures();

    /**
     * @param $types
     * @return bool
     */
    public function isOfType($types): bool;

    /**
     * @return CategoryInterface[]
     */
    public function get_categories(): ?array;

    /**
     * @return int|null
     */
    public function getId1c(): ?int;

    /**
     * @param int $categoryId
     * @return bool
     */
    public function hasCategory(int $categoryId): bool;

    /**
     * @return null|String
     */
    public function get_description(): ?String;

    /**
     * @return null|String
     */
    public function get_tag_line(): ?String;

    /**
     * @return int|null
     */
    public function getPriceCurrent(): ?int;

    /**
     * @return bool
     */
    public function getPriceVariable(): bool;

    /**
     * @param bool $valid
     * @return void
     */
    public function setValid(bool $valid);

    /**
     * @param $feature
     * @return bool
     */
    public function hasFeature($feature): bool;

    /**
     * @return bool
     */
    public function is_bike(): bool;

    /**
     * @return bool
     */
    public function isKickScooter(): bool;

    /**
     * @param string $key
     * @param $value
     * @return void
     */
    public function setFeatureValue(string $key, $value);

    /**
     * @param int $total
     * @return void
     */
    public function setStockTotal(int $total);

    /**
     * @return int|null
     */
    public function getStockTotal(): ?int;

    /**
     * @param int $price
     * @return void
     */
    public function setPriceCurrent(int $price);

    /**
     * @param int $price
     * @return void
     */
    public function setPriceOld(int $price);

    /**
     * @return int|null
     */
    public function getPriceOld(): ?int;

    /**
     * @param $key
     * @return ProductFeatureInterface
     */
    public function getFeature($key);

    /**
     * @param $value
     * @return void
     */
    public function setHasPreOrder($value);

    /**
     * @return int|null
     */
    public function getId(): ?int;

    /**
     * @param $valid
     * @return void
     */
    public function setAdditionalFilterValid($valid);

    /**
     * @param string $key
     * @return void
     */
    public function deleteFeature(string $key);

    /**
     * @param int $count
     * @return void
     */
    public function setCartCount(int $count);

    /**
     * @param int $count
     * @return void
     */
    public function setViewsCount(int $count);

    /**
     * @return bool
     */
    public function is_for_children(): bool;

    /**
     * @return CategoryInterface
     */
    public function getCanonicalCategory(): CategoryInterface;

    /**
     * @return BrandInterface
     */
    public function getBrand(): BrandInterface;

    /**
     * @return null|string
     */
    public function getFullName(): ?string;

    /**
     * @return int|null
     */
    public function getViewsCount(): ?int;

    /**
     * @return int|null
     */
    public function getCartCount(): ?int;

    /**
     * @return int|null
     */
    public function getStockWarehouse(): ?int;

    /**
     * @return int|null
     */
    public function getStockShop(): ?int;

    /**
     * @return mixed
     */
    public function getComments();

    /**
     * @return ProductFeatureInterface[]
     */
    public function getFeatures();

    /**
     * @param $value
     * @return void
     */
    public function setSortPopularity($value);

    /**
     * @param $value
     * @return void
     */
    public function setSortComments($value);

    /**
     * @param $value
     * @return void
     */
    public function setSortPrice($value);

    /**
     * @param $value
     */
    public function setColorCountInStock($value);

    /**
     * @param $gender
     * @return void
     */
    public function setGender($gender);

}