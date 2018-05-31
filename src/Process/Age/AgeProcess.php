<?php
/**
 * Class AgeProcess
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Process\Age;


use Validator\Process\AbstractProcess;
use Validator\Process\Interfaces\ProcessInterface;
use Validator\Product\ProductInterface;
use Validator\Services\AgeService;

class AgeProcess extends AbstractProcess implements ProcessInterface
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