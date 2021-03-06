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
     * @return bool
     */
    public function validate(ProductInterface $product): bool
    {
        $isValid = true;
        $productFactory = new ProductValidatorFactory();
        $productFactory->make();
        foreach ($productFactory->getValidators() as $validator) {
            if ($validator->validate($product) === false && ($validator->isRequired())) {
                $isValid = false;
            }
            foreach ($validator->getMessages() as $message) {
                $this->addMessage($message);
            }
        }

        return $isValid;
    }
}