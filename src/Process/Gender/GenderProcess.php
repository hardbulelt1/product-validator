<?php
/**
 * Class GenderProcess
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Process\Gender;


use Validator\Process\AbstractProcess;
use Validator\Process\Interfaces\ProcessInterface;
use Validator\Models\Product\ProductInterface;
use Validator\Services\GenderService;

class GenderProcess extends AbstractProcess implements ProcessInterface
{
    /**
     * @param ProductInterface $product
     */
    public function run(ProductInterface $product)
    {
        $genderService = new GenderService($product);
        $product->setFeatureValue('gender', $genderService->getGender());
    }
}