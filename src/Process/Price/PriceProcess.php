<?php
/**
 * Class PriceProcess
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Process\Price;


use Validator\Process\Interfaces\ProcessInterface;
use Validator\Models\Product\ProductInterface;

class PriceProcess implements ProcessInterface
{

    /**
     * @param ProductInterface $product
     */
    public function run(ProductInterface $product)
    {
        $priceCurrent = 0;
        $priceOld = 0;
        foreach ($product->getSku() as $sku) {
            if ($priceCurrent < $sku->getPriceCurrent()) {
                $priceCurrent = $sku->getPriceCurrent();
            }
            if ($priceOld < $sku->getPriceOld()) {
                $priceOld = $sku->getPriceOld();
            }
        }
        $product->setPriceCurrent($priceCurrent);
        $product->setPriceOld($priceOld);
        $product->setFeatureValue('is_sale', $product->getPriceOld() > $product->getPriceCurrent());
        $product->setHasPreOrder(
            $product->hasFeature('year') &&
            $product->getFeature('year')->getValue() == date('Y') &&
            $product->getStockTotal() == 0);
    }
}