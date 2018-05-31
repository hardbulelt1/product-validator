<?php
/**
 * Class ProcessInterface
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */
namespace Validator\Process\Interfaces;

use Validator\Models\Product\ProductInterface;

interface ProcessInterface
{
    public function run(ProductInterface $pro);
}