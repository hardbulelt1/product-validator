<?php
/**
 * Class ProductProcess
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Process;

use Doctrine\ORM\EntityManager;
use Validator\Process\Factory\ProcessFactory;
use Validator\Process\Interfaces\ProcessInterface;
use Validator\Models\Product\ProductInterface;
use Validator\Services\Contracts\Catalog\CatalogServiceContract;
use Validator\Services\Contracts\Feature\FeatureServiceContract;
use Validator\Services\Contracts\Series\SeriesServiceContract;
use Validator\Services\Contracts\Tag\TagRulesServiceContract;

class ProductProcess implements ProcessInterface
{
    private $catalogService;
    private $featureService;
    private $seriesService;
    private $tagRulesService;
    private $em;

    public function __construct(
        EntityManager $entityManager,
        CatalogServiceContract $catalogServiceContract,
        FeatureServiceContract $featureServiceContract,
        SeriesServiceContract $seriesServiceContract,
        TagRulesServiceContract $tagRulesServiceContract
    )
    {
        $this->catalogService = $catalogServiceContract;
        $this->featureService = $featureServiceContract;
        $this->seriesService = $seriesServiceContract;
        $this->tagRulesService = $tagRulesServiceContract;
        $this->em = $entityManager;
    }

    /**
     * @param ProductInterface $product
     */
    public function run(ProductInterface $product)
    {
        $factory = new ProcessFactory($this->em, $this->catalogService, $this->featureService, $this->seriesService, $this->tagRulesService);
        $processes = $factory->make()->getProcess();
        foreach ($processes as $process) {
            $process->run($product);
        }
    }
}