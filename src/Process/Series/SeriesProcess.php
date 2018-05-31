<?php
/**
 * Class SeriesProcess
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Process\Series;

use Validator\Process\Interfaces\ProcessInterface;
use Validator\Models\Product\ProductInterface;
use Validator\Services\Contracts\Series\SeriesServiceContract;

class SeriesProcess implements ProcessInterface
{
    private $series;

    /**
     * SeriesProcess constructor.
     * @param SeriesServiceContract $series
     */
    public function __construct(SeriesServiceContract $series)
    {
        $this->series = $series;
    }

    /**
     * @param ProductInterface $product
     */
    public function run(ProductInterface $product)
    {

        $seriesCode = $this->series->getSeries($product);
        if ($seriesCode === false) {
            $product->deleteFeature('series');
        } else {
            $product->setFeatureValue('series', $seriesCode);
        }
    }
}