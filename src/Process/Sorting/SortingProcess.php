<?php
/**
 * Class SortingProcess
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Process\Sorting;
use Validator\Process\Interfaces\ProcessInterface;
use Validator\Models\Product\ProductInterface;
use Validator\Services\Contracts\Catalog\CatalogServiceContract;


class SortingProcess  implements ProcessInterface
{
    private $catalog;

    public function __construct(CatalogServiceContract $catalog)
    {
        $this->catalog = $catalog;
    }

    public function run(ProductInterface $product)
    {
        $maxStock = $this->catalog->getMaxStock();
        $maxViews = $this->catalog->getMaxViews();
        $maxCart = $this->catalog->getMaxCart();
        $maxComments = $this->catalog->getMaxComments();
        $maxPrice = $this->catalog->getMaxPrice();
        if (count($product->get_categories()) > 0) {
            $maxOwnStockInCategory = $this->catalog->getMaxOwnStockPerCategory($product->getCanonicalCategory()->getId());
        } else {
            $maxOwnStockInCategory = $this->catalog->getMaxOwnStock();
        }

        $basicSortWeight = 0;
        $basicSortWeight += $product->getStockTotal() / $maxStock * .35;
        $basicSortWeight += $product->getViewsCount() / $maxViews * .25;
        $basicSortWeight += $product->getCartCount() / $maxCart * .15;
        if ($maxOwnStockInCategory > 0) {
            $basicSortWeight += ($product->getStockWarehouse() + $product->getStockShop()) / $maxOwnStockInCategory * .25;
        }

        $sortPopularity = $basicSortWeight;
        $sortComments = count($product->getComments()) / $maxComments;
        $sortPrice = !is_numeric($product->getPriceCurrent()) ? 0 : $product->getPriceCurrent() / $maxPrice;

        $colors = [];
        foreach ($product->getSku() as $sku) {
            $colorId = $sku->getColorId();
            if ($colorId >= 0 && $sku->getTotalStock() > 0 && !in_array($colorId, $colors)) {
                $colors[] = $colorId;
            }
        }
        $colorCount = count($colors);

        $gender = null;
        foreach ($product->getFeatures() as $feature) {
            if ($feature->getFeatureCode() == 'gender') {
                $gender = $feature->getValues()[0]->valueInteger ?? null;
                break;
            }
        }

        $product->setSortPopularity($sortPopularity);
        $product->setSortComments($sortComments);
        $product->setSortPrice($sortPrice);
        $product->setColorCountInStock($colorCount);
        $product->setGender($gender);
    }
}