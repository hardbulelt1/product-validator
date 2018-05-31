<?php
/**
 * Class ProductProcess
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */
namespace Validator\Process;
use Validator\Process\Factory\ProcessFactory;
use Validator\Process\Interfaces\ProcessInterface;
use Validator\Product\ProductInterface;

class ProductProcess extends AbstractProcess implements ProcessInterface
{
    /**
     * @param ProductInterface $product
     */
    public function run(ProductInterface $product)
    {
         $processFactory = new ProcessFactory($this->em);
         $processes = $processFactory->make()->getProcess();
         foreach ($processes as $process) {
             $process->run($product);
         }
    }
}