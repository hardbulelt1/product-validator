<?php
/**
 * Class SeriesProcess
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Process\Series;


use Validator\Models\Series\SeriesInterface;
use Validator\Process\AbstractProcess;
use Validator\Process\Interfaces\ProcessInterface;
use Validator\Product\ProductInterface;

class SeriesProcess extends AbstractProcess implements ProcessInterface
{
    /**
     * @param ProductInterface $product
     */
    public function run(ProductInterface $product)
    {

        $seriesCode = $this->getSeries($product);
        if ($seriesCode === false) {
            $product->deleteFeature('series');
        } else {
            $product->setFeatureValue('series', $seriesCode);
        }
    }

    /**
     * @param ProductInterface $product
     * @return bool
     */
    private function getSeries(ProductInterface $product)
    {
        $brand = $product->getBrand();
        $brandSeries = $brand->getSeries();
        foreach ($brandSeries as $seriesCode) {
            /** @var SeriesInterface $series */
            $series = $this->em->getRepository(SeriesInterface::class)->findBy(['code' => $seriesCode]);
            if (!is_null($series)) {
                if (strpos(mb_strtolower($product->getFullName(), 'UTF-8'),
                    mb_strtolower($series->getRule(), 'UTF-8'))) {
                    return $seriesCode;
                }
            }
        }

        return false;
    }
}