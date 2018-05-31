<?php
/**
 * Class AgeProcess
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Process\Age;


use Validator\Process\Interfaces\ProcessInterface;
use Validator\Models\Product\ProductInterface;
use Validator\Services\AgeService;

class AgeProcess implements ProcessInterface
{
    /**
     * @param ProductInterface $product
     */
    public function run(ProductInterface $product)
    {
        $ageService = new AgeService($product);
        $product->setFeatureValue('age', $ageService->getAgeRange());
    }
}