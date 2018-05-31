<?php
/**
 * Class StockProcess
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Process\Stock;

use Validator\Process\Interfaces\ProcessInterface;
use Validator\Models\Product\ProductInterface;

class StockProcess implements ProcessInterface
{
    /**
     * @param ProductInterface $product
     */
    public function run(ProductInterface $product)
    {
        $stockTotal = 0;
        foreach ($product->getSku() as $sku) {
            if ($sku->isValid()) {
                $stockTotal += $sku->getTotalStock();
            }
        }
        $product->setStockTotal($stockTotal);
        $product->setFeatureValue('in_stock', $product->getStockTotal() > 0);
    }
}