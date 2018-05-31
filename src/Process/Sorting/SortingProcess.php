<?php
/**
 * Class SortingProcess
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Process\Sorting;


use Validator\Process\AbstractProcess;
use Validator\Process\Interfaces\ProcessInterface;
use Validator\Product\ProductInterface;

class SortingProcess extends AbstractProcess implements ProcessInterface
{

    public function run(ProductInterface $product)
    {
//        $catalog = new Catalog();
//
//        $maxStock = $catalog->getMaxStock();
//        $maxViews = $catalog->getMaxViews();
//        $maxCart = $catalog->getMaxCart();
//        $maxComments = $catalog->getMaxComments();
//        $maxPrice = $catalog->getMaxPrice();
//        if (count($this->product->get_categories()) > 0) {
//            $maxOwnStockInCategory = $catalog->getMaxOwnStockPerCategory($this->product->getCanonicalCategory()->getId());
//        } else {
//            $maxOwnStockInCategory = $catalog->getMaxOwnStock();
//        }
//
//        $basicSortWeight = 0;
//        $basicSortWeight += $this->product->stockTotal / $maxStock * .0;
//        $basicSortWeight += $this->product->viewsCount / $maxViews * .15;
//        $basicSortWeight += $this->product->cartCount / $maxCart * .35;
//        if ($maxOwnStockInCategory > 0) {
//            $basicSortWeight += ($this->product->stockWarehouse + $this->product->stockShop) / $maxOwnStockInCategory * .5;
//        }
//
//        $sortPopularity = $basicSortWeight;
//        $sortComments = count($this->product->comments) / $maxComments;
//        $sortPrice = $this->product->priceCurrent / $maxPrice;
//
//        $colors = [];
//        foreach ($this->product->sku as $sku) {
//            $colorId = $sku->getColorId();
//            if ($colorId >= 0 && $sku->getTotalStock() > 0 && !in_array($colorId, $colors)) {
//                $colors[] = $colorId;
//            }
//        }
//        $colorCount = count($colors);
//
//        $gender = null;
//        foreach ($this->product->features as $feature) {
//            if ($feature->featureCode == 'gender') {
//                $gender = $feature->values[0]->valueInteger;
//                break;
//            }
//        }
//
//        $this->product->sortPopularity = $sortPopularity;
//        $this->product->sortComments = $sortComments;
//        $this->product->sortPrice = $sortPrice;
//        $this->product->setColorCountInStock($colorCount);
//        $this->product->setGender($gender);
    }
}