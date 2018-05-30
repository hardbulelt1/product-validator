<?php
/**
 * Class ProductInterface
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Product;

use Validator\Category\CategoryInterface;
use Validator\Feature\FeatureInterface;
use Validator\Sku\SkuInterface;

interface ProductInterface
{
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
    public function getSku(): ?array;

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

    public function setFeatureValue($key,$value);

    public function setStockTotal($total);

    public function getStockTotal();

    public function setPriceCurrent($price);

    public function setPriceOld($price);
    public function getPriceOld();

    /**
     * @param $key
     * @return FeatureInterface
     */
    public function getFeature($key);

    public function setHasPreOrder($value);

    public function getId();

    public function setAdditionalFilterValid($valid);

    public function deleteFeature($key);

    public function setCartCount($count);

    public function setViewsCount($count);
}