<?php
/**
 * Class ProductTagger
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Services;


use Validator\Product\ProductInterface;
use Validator\TagRules\TagRulesInterface;

class ProductTagger
{
    private $product;
    private $tagRules;

    public function __construct(ProductInterface $product, array $tagRules)
    {
        $this->product = $product;
        $this->tagRules = $tagRules;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getTags()
    {
        if ($this->product->hasFeature('tag')) {
            $tags = $this->product->getFeature('tag')->getValue();
        } else {
            $tags = [];
        }
        foreach ($this->tagRules as $rule) {
            $tagId = $rule->getTagId();
            $hasTag = $this->productFitsRule($rule);
            if ($hasTag) {
                $tags[] = $tagId;
            } else {
                if (($key = array_search($tagId, $tags)) !== false) {
                    unset($tags[$key]);
                }
            }
        }

        return $tags;
    }

    /**
     * @param TagRulesInterface $tagRule
     * @return bool
     */
    private function productFitsRule(TagRulesInterface $tagRule)
    {
        $featureService = new FeatureService();
        $data = $tagRule->getData();
        if (count($data) === 0) {
            return false;
        }
        foreach ($data as $key => $value) {
            if ($key === 'priceFrom') {
                if ($value > 0 && $this->product->getPriceCurrent() < $value) {
                    return false;
                }
            }
            if ($key === 'priceTo') {
                if ($value > 0 && $this->product->getPriceCurrent() > $value) {
                    return false;
                }
            }
            if ($key === 'availability' && $value > -1) {
                if ($value == 0 && $this->product->getStockTotal() > 0) {
                    return false;
                }
                if ($value == 1 && $this->product->getStockTotal() == 0) {
                    return false;
                }
            }
            if ($featureService->isExist($key)) {
                $feature = $featureService->getByCode($key);
                if ($feature->getIsForProduct()) {
                    if (!$this->product->hasFeature($key)) {
                        return false;
                    }
                    $productValues = $this->product->getFeature($key)->getValue();
                    if (!is_array($productValues)) {
                        $productValues = [$productValues];
                    }
                    if ($value['type'] === 'or' && count(array_intersect($productValues, $value['values'])) == 0) {
                        return false;
                    }
                    if ($value['type'] === 'and' && count(array_intersect($productValues,
                            $value['values'])) != count($value['values'])) {
                        return false;
                    }
                }
                if ($feature->getIsForSku()) {
                    $skuCompliesWithRule = false;
                    foreach ($this->product->getSku() as $sku) {
                        if ($sku->hasFeature($key)) {
                            $skuFeatureValues = $sku->getFeature($key)->getValue();
                            if (!is_array($skuFeatureValues)) {
                                $skuFeatureValues = [$skuFeatureValues];
                            }
                            if ($value['type'] === 'or' && count(array_intersect($skuFeatureValues,
                                    $value['values'])) > 0) {
                                $skuCompliesWithRule = true;
                                break;
                            }
                            if ($value['type'] === 'and' && count(array_intersect($skuFeatureValues,
                                    $value['values'])) == count($value['values'])) {
                                $skuCompliesWithRule = true;
                                break;
                            }
                        }
                    }
                    if (!$skuCompliesWithRule) {
                        return false;
                    }
                }
            }
        }

        return true;
    }
}