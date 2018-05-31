<?php
/**
 * Class CategoryInterface
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */
namespace Validator\Category;

interface CategoryInterface
{
    const BIKES_ID = 1;
    const ACCESSORIES_ID = 2;
    const SPARES_ID = 3;
    const KICK_SCOOTERS_ID = 113;
    const GIFT_CARDS_ID = 114;
    const SERVICES_ID = 115;

    /**
     * @return int|null
     */
    public function getId(): ?int;
}