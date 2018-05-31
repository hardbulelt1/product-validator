<?php
/**
 * Class TagProcess
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */
namespace Validator\Process\Tag;

use Doctrine\ORM\EntityManager;
use Validator\Process\Interfaces\ProcessInterface;
use Validator\Models\Product\ProductInterface;
use Validator\Services\Contracts\Feature\FeatureServiceContract;
use Validator\Services\Contracts\Tag\TagRulesServiceContract;
use Validator\Services\ProductTagger;

class TagProcess  implements ProcessInterface
{
    private $em;
    private $featureService;
    private $tagRulesService;

    /**
     * TagProcess constructor.
     * @param EntityManager $entityManager
     * @param FeatureServiceContract $featureServiceContract
     * @param TagRulesServiceContract $tagRulesServiceContract
     */
    public function __construct(EntityManager $entityManager,FeatureServiceContract $featureServiceContract,TagRulesServiceContract $tagRulesServiceContract)
    {
        $this->em = $entityManager;
        $this->featureService = $featureServiceContract;
        $this->tagRulesService = $tagRulesServiceContract;
    }

    /**
     * @param ProductInterface $product
     */
    public function run(ProductInterface $product)
    {
        $tagRules = $this->tagRulesService->findAll();
        $productTagger = new ProductTagger($product, $tagRules,$this->featureService);
        $tags = $productTagger->getTags();
        if ($product->hasFeature('tag')) {
            $product->deleteFeature('tag');
        }
        if (count($tags) > 0) {
            foreach ($tags as &$tag) {
                $tag = (int)$tag;
            }
            $tags = array_values(array_unique($tags));
            $product->setFeatureValue('tag', $tags);
        }
    }
}