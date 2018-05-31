<?php
/**
 * Class ProcessInterface
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */
namespace Validator\Process\Interfaces;

use Validator\Product\ProductInterface;

interface ProcessInterface
{
    public function run(ProductInterface $product);
}