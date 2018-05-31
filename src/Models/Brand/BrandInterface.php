<?php
/**
 * Class BrandInterface
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Models\Brand;


use Validator\Models\Series\SeriesInterface;

interface BrandInterface
{
    /**
     * @return SeriesInterface[]
     */
    public function getSeries();
}