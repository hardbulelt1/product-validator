<?php
/**
 * Class TagProcess
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */
namespace Validator\Process\Tag;

use Validator\Process\AbstractProcess;
use Validator\Process\Interfaces\ProcessInterface;
use Validator\Product\ProductInterface;
use Validator\Services\FeatureService;
use Validator\Services\ProductTagger;
use Validator\Services\TagRulesService;

class TagProcess extends AbstractProcess implements ProcessInterface
{
    /**
     * @param ProductInterface $product
     */
    public function run(ProductInterface $product)
    {
        $tagRulesService = new TagRulesService($this->em);
        $tagRules = $tagRulesService->getAll();
        $featureService = new FeatureService($this->em);
        $productTagger = new ProductTagger($product, $tagRules,$featureService);
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