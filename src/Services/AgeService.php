<?php
/**
 * Class AgeService
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Services;


use Validator\Models\Product\ProductInterface;

class AgeService
{



    /** @var ProductInterface $product */
    private $product;

    public function __construct(ProductInterface $product)
    {
        $this->product = $product;
    }

    /**
     * @return array
     */
    public function getAgeRange()
    {
        if ($this->product->is_for_children() && $this->product->hasFeature('wheel_size')) {
            $wheelSize = $this->product->getFeature('wheel_size')->getData('numeric');
            if (isset(self::$ageByWheelSize[$wheelSize])) {
                return range(
                    self::$ageByWheelSize[$wheelSize]['min'],
                    self::$ageByWheelSize[$wheelSize]['max']
                );
            }
        }

        return [];
    }

    /**
     * @var array
     */
    private static $ageByWheelSize = [
        12 => ['min' => 1, 'max' => 3],
        14 => ['min' => 3, 'max' => 4],
        16 => ['min' => 4, 'max' => 5],
        18 => ['min' => 4, 'max' => 6],
        20 => ['min' => 5, 'max' => 9],
        24 => ['min' => 8, 'max' => 12],
    ];
}