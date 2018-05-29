<?php
/**
 * Class ProductInterface
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

interface ProductInterface
{
    const TYPE_BIKE = 'bike';
    const TYPE_KICK_SCOOTER = 'kickScooter';
    const TYPE_ACCESSORY = 'accessory';
    const TYPE_SPARE_PART = 'spare_part';
    const TYPE_WORKSHOP_SERVICE = 'workshop_service';
    const TYPE_GIFT_CARD = 'gift_card';
    const TYPE_OTHER = 'other';

    public function getSku();

    public function getCode();

    public function getModel();

    public function getPictures();

    public function isOfType($types);

    public function get_categories();
    public function getId1c();
    public function hasCategory(int $categoryId);
    public function getDescription();
    public function getTagLine();
    public function getPriceCurrent();
    public function getIsPriceVariable();

    public function setValid(bool $valid);
    public function hasFeature($feature);
    public function is_bike();
    public function isKickScooter();
}