<?php
/**
 * Class StatureProcess
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Process\Stature;


use Validator\Process\AbstractProcess;
use Validator\Process\Interfaces\ProcessInterface;
use Validator\Models\Product\ProductInterface;
use Validator\Services\StatureService;

class StatureProcess extends AbstractProcess implements ProcessInterface
{
    /**
     * @param ProductInterface $product
     */
    public function run(ProductInterface $product)
    {
        $statureService = new StatureService($product);
        $statureService->fillStatureData();
    }
}