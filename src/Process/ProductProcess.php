<?php
/**
 * Class ProductProcess
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */
namespace Validator\Process;
use Validator\Process\Factory\ProcessFactory;
use Validator\Process\Interfaces\ProcessInterface;
use Validator\Models\Product\ProductInterface;

class ProductProcess  implements ProcessInterface
{
    private $processFactory;

    public function __construct(ProcessFactory $factory)
    {
        $this->processFactory = $factory;
    }

    /**
     * @param ProductInterface $product
     */
    public function run(ProductInterface $product)
    {
         $processes = $this->processFactory->make()->getProcess();
         foreach ($processes as $process) {
             $process->run($product);
         }
    }
}