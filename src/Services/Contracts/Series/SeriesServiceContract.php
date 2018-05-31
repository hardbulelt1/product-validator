<?php
/**
 * Class SeriesServiceContract
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Services\Contracts\Series;


use Validator\Models\Product\ProductInterface;

interface SeriesServiceContract
{
    /**
     * @param ProductInterface $productInterface
     * @return bool
     */
    public function getSeries(ProductInterface $productInterface);
}