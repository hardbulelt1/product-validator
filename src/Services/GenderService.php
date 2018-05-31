<?php
/**
 * Class GenderService
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Services;


use Validator\Product\ProductInterface;

class GenderService
{
    /** @var ProductInterface $product */
    private $product;

    public function __construct(ProductInterface $product)
    {
        $this->product = $product;
    }

    /**
     * @return int
     */
    public function getGender()
    {
        $isForChild = $this->product->is_for_children();
        if ($isForChild) {
            $hasWomenColor = false;
            $hasWomenName = strpos(mb_strtolower($this->product->getModel()), 'girl') !== false;
            foreach ($this->product->getSku() as $sku) {
                if (in_array($sku->getColorId(), [8, 9])) {
                    $hasWomenColor = true;
                }
            }

            return ($this->product->hasCategory(5) || $hasWomenColor || $hasWomenName)
                ? 3
                : 2;
        } else {
            return $this->product->hasCategory(5)
                ? 1
                : 0;
        }
    }
}