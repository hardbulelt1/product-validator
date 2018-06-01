<?php
/**
 * Class ProductValidator
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Validator;

use Doctrine\ORM\EntityManager;
use Validator\Models\Product\ProductInterface;
use Validator\Process\Factory\ProcessFactory;
use Validator\Process\ProductProcess;
use Validator\Services\Contracts\Catalog\CatalogServiceContract;
use Validator\Services\Contracts\Feature\FeatureServiceContract;
use Validator\Services\Contracts\Series\SeriesServiceContract;
use Validator\Services\Contracts\Tag\TagRulesServiceContract;
use Validator\Validator\Contracts\Product\ProductValidatorContract;
use Validator\Validator\Factory\ProductValidatorFactory;


class ProductValidator extends Validator implements ProductValidatorContract
{

    private $catelogService;
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
        $this->catelogService = $catalogServiceContract;
        $this->featureService = $featureServiceContract;
        $this->seriesService = $seriesServiceContract;
        $this->tagRulesService = $tagRulesServiceContract;
        $this->em = $entityManager;
    }

    /**
     * @param ProductInterface $product
     * @return bool
     */
    public function validate(ProductInterface $product): bool
    {
        $factory = new ProcessFactory($this->em, $this->catelogService, $this->featureService, $this->seriesService, $this->tagRulesService);
        $productProcess = new ProductProcess($factory);
        $productProcess->run($product);
        $is_validate = true;
        $productFactory = new ProductValidatorFactory();
        $productFactory->make();
        foreach ($productFactory->getValidators() as $validator) {
            if ($validator->validate($product) === false && ($validator->isRequired())) {
                $is_validate = false;
            }
            foreach ($validator->getMessages() as $message) {
                $this->addMessage($message);
            }
        }

        return $is_validate;
    }
}