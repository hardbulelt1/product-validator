<?php
/**
 * Class StatureService
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Services;


use Validator\Models\Product\ProductInterface;
use Validator\Models\Sku\SkuInterface;

class StatureService
{
    private $product;

    public function __construct(ProductInterface $product)
    {
        $this->product = $product;
    }

    public function fillStatureData()
    {
        $productMin = 0;
        $productMax = 0;
        foreach ($this->product->getSku() as $sku) {
            list($min, $max) = $this->getStatureRange($sku);
            $sku->setStatureMin($min);
            $sku->setStatureMax($max);
            if ($sku->getTotalStock() > 0) {
                if ($productMin == 0 || $productMin > $min) {
                    $productMin = $min;
                }
                if ($productMax == 0 || $productMax < $max) {
                    $productMax = $max;
                }
            }
        }
    }

    private function getStatureRange(SkuInterface $sku)
    {
        $min_stature = 0;
        $max_stature = 0;
        $isForChildren = $this->product->is_for_children();
        if ($isForChildren && $this->product->hasFeature('wheel_size')) {
            $wheelSize = $this->product->getFeature('wheel_size')->getData('numeric');
            if (isset(self::$statureByWheelSize[$wheelSize])) {
                $min_stature = self::$statureByWheelSize[$wheelSize]['min'];
                $max_stature = self::$statureByWheelSize[$wheelSize]['max'];
            }
        } elseif ($sku->hasFeature('frame_size')) {
            $frame_size = (string)$sku->getFeature('frame_size')->getData('numeric');
            $categoryId = $this->product->getCanonicalCategory()->getId();
            if (isset(self::$statureByCategoryAndFrameSize[$categoryId][$frame_size])) {
                $min_stature = self::$statureByCategoryAndFrameSize[$categoryId][$frame_size]['min'];
                $max_stature = self::$statureByCategoryAndFrameSize[$categoryId][$frame_size]['max'];
            } elseif (isset(self::$statureByCategoryAndFrameSize[0][$frame_size])) {
                $min_stature = self::$statureByCategoryAndFrameSize[0][$frame_size]['min'];
                $max_stature = self::$statureByCategoryAndFrameSize[0][$frame_size]['max'];
            }
        }

        return [
            $min_stature,
            $max_stature,
        ];
    }

    private static $statureByWheelSize = [
        12 => ['min' => 90, 'max' => 108],
        14 => ['min' => 95, 'max' => 114],
        16 => ['min' => 100, 'max' => 117],
        18 => ['min' => 110, 'max' => 119],
        20 => ['min' => 115, 'max' => 134],
        24 => ['min' => 135, 'max' => 149],
    ];

    private static $statureByCategoryAndFrameSize = [
        4 => [
            '0' => ['min' => 160, 'max' => 175],
            '12' => ['min' => 135, 'max' => 150],
            '12.5' => ['min' => 135, 'max' => 150],
            '13' => ['min' => 140, 'max' => 155],
            '13.5' => ['min' => 140, 'max' => 155],
            '14' => ['min' => 145, 'max' => 160],
            '14.5' => ['min' => 145, 'max' => 160],
            '15' => ['min' => 150, 'max' => 165],
            '15.5' => ['min' => 152, 'max' => 163],
            '16' => ['min' => 155, 'max' => 168],
            '16.5' => ['min' => 157, 'max' => 170],
            '17' => ['min' => 160, 'max' => 175],
            '17.5' => ['min' => 162, 'max' => 177],
            '18' => ['min' => 165, 'max' => 180],
            '18.5' => ['min' => 167, 'max' => 182],
            '19' => ['min' => 170, 'max' => 185],
            '19.5' => ['min' => 172, 'max' => 187],
            '20' => ['min' => 175, 'max' => 190],
            '20.5' => ['min' => 177, 'max' => 192],
            '21' => ['min' => 182, 'max' => 195],
            '21.5' => ['min' => 185, 'max' => 197],
            '22' => ['min' => 185, 'max' => 200],
            '22.5' => ['min' => 190, 'max' => 200],
            '23' => ['min' => 192, 'max' => 202],
            '23.5' => ['min' => 195, 'max' => 205],
            '24' => ['min' => 197, 'max' => 207],
            '24.5' => ['min' => 200, 'max' => 250],
            '25' => ['min' => 200, 'max' => 250],
            '25.5' => ['min' => 200, 'max' => 250],
            '26' => ['min' => 200, 'max' => 250],
            '27' => ['min' => 197, 'max' => 250],
        ],
        6 => [
            '0' => ['min' => 160, 'max' => 174],
            '12' => ['min' => 135, 'max' => 150],
            '12.5' => ['min' => 135, 'max' => 150],
            '13' => ['min' => 137, 'max' => 153],
            '13.5' => ['min' => 139, 'max' => 155],
            '14' => ['min' => 141, 'max' => 157],
            '14.5' => ['min' => 145, 'max' => 159],
            '15' => ['min' => 147, 'max' => 161],
            '15.5' => ['min' => 149, 'max' => 163],
            '16' => ['min' => 151, 'max' => 165],
            '16.5' => ['min' => 153, 'max' => 167],
            '17' => ['min' => 155, 'max' => 169],
            '17.5' => ['min' => 157, 'max' => 170],
            '18' => ['min' => 160, 'max' => 172],
            '18.5' => ['min' => 162, 'max' => 174],
            '19' => ['min' => 163, 'max' => 177],
            '19.5' => ['min' => 165, 'max' => 179],
            '20' => ['min' => 168, 'max' => 183],
            '20.5' => ['min' => 173, 'max' => 187],
            '21' => ['min' => 176, 'max' => 188],
            '21.5' => ['min' => 178, 'max' => 190],
            '22' => ['min' => 181, 'max' => 192],
            '22.5' => ['min' => 185, 'max' => 197],
            '23' => ['min' => 187, 'max' => 201],
            '23.5' => ['min' => 191, 'max' => 203],
            '24' => ['min' => 193, 'max' => 205],
            '24.5' => ['min' => 195, 'max' => 207],
            '25' => ['min' => 197, 'max' => 250],
            '25.5' => ['min' => 197, 'max' => 250],
            '26' => ['min' => 197, 'max' => 250],
            '27' => ['min' => 197, 'max' => 250],
            '46' => ['min' => 160, 'max' => 165],
            '47' => ['min' => 160, 'max' => 165],
            '48' => ['min' => 160, 'max' => 169],
            '49' => ['min' => 160, 'max' => 169],
            '50' => ['min' => 166, 'max' => 174],
            '51' => ['min' => 166, 'max' => 174],
            '52' => ['min' => 166, 'max' => 174],
            '53' => ['min' => 166, 'max' => 174],
            '54' => ['min' => 180, 'max' => 184],
            '55' => ['min' => 180, 'max' => 184],
            '56' => ['min' => 180, 'max' => 184],
            '57' => ['min' => 180, 'max' => 184],
            '58' => ['min' => 180, 'max' => 187],
            '59' => ['min' => 185, 'max' => 187],
            '60' => ['min' => 185, 'max' => 194],
            '61' => ['min' => 185, 'max' => 194],
            '62' => ['min' => 188, 'max' => 210],
            '63' => ['min' => 190, 'max' => 210],
        ],
        8 => [
            '0' => ['min' => 154, 'max' => 163],
            '12' => ['min' => 154, 'max' => 163],
            '12.5' => ['min' => 154, 'max' => 163],
            '13' => ['min' => 154, 'max' => 163],
            '13.5' => ['min' => 154, 'max' => 163],
            '14' => ['min' => 154, 'max' => 163],
            '14.5' => ['min' => 154, 'max' => 163],
            '15' => ['min' => 154, 'max' => 163],
            '15.5' => ['min' => 154, 'max' => 163],
            '16' => ['min' => 154, 'max' => 163],
            '16.5' => ['min' => 154, 'max' => 163],
            '17' => ['min' => 156, 'max' => 163],
            '17.5' => ['min' => 156, 'max' => 165],
            '18' => ['min' => 158, 'max' => 165],
            '18.5' => ['min' => 160, 'max' => 165],
            '19' => ['min' => 160, 'max' => 169],
            '19.5' => ['min' => 163, 'max' => 175],
            '20' => ['min' => 167, 'max' => 177],
            '20.5' => ['min' => 170, 'max' => 179],
            '21' => ['min' => 173, 'max' => 181],
            '21.5' => ['min' => 175, 'max' => 185],
            '22' => ['min' => 178, 'max' => 188],
            '22.5' => ['min' => 182, 'max' => 190],
            '23' => ['min' => 185, 'max' => 195],
            '23.5' => ['min' => 189, 'max' => 197],
            '24' => ['min' => 190, 'max' => 199],
            '24.5' => ['min' => 190, 'max' => 201],
            '25' => ['min' => 193, 'max' => 204],
            '25.5' => ['min' => 193, 'max' => 250],
            '26' => ['min' => 193, 'max' => 250],
            '27' => ['min' => 197, 'max' => 250],
            '46' => ['min' => 160, 'max' => 165],
            '47' => ['min' => 160, 'max' => 165],
            '48' => ['min' => 160, 'max' => 169],
            '49' => ['min' => 160, 'max' => 169],
            '50' => ['min' => 166, 'max' => 174],
            '51' => ['min' => 166, 'max' => 174],
            '52' => ['min' => 166, 'max' => 174],
            '53' => ['min' => 166, 'max' => 174],
            '54' => ['min' => 180, 'max' => 184],
            '55' => ['min' => 180, 'max' => 184],
            '56' => ['min' => 180, 'max' => 184],
            '57' => ['min' => 180, 'max' => 184],
            '58' => ['min' => 180, 'max' => 187],
            '59' => ['min' => 185, 'max' => 187],
            '60' => ['min' => 185, 'max' => 194],
            '61' => ['min' => 185, 'max' => 194],
            '62' => ['min' => 188, 'max' => 210],
            '63' => ['min' => 190, 'max' => 210],

        ],
        0 => [
            '0' => ['min' => 160, 'max' => 175],
            '12' => ['min' => 135, 'max' => 150],
            '12.5' => ['min' => 135, 'max' => 150],
            '13' => ['min' => 140, 'max' => 155],
            '13.5' => ['min' => 140, 'max' => 155],
            '14' => ['min' => 145, 'max' => 160],
            '14.5' => ['min' => 145, 'max' => 160],
            '15' => ['min' => 150, 'max' => 165],
            '15.5' => ['min' => 150, 'max' => 165],
            '16' => ['min' => 155, 'max' => 166],
            '16.5' => ['min' => 157, 'max' => 170],
            '17' => ['min' => 160, 'max' => 175],
            '17.5' => ['min' => 162, 'max' => 177],
            '18' => ['min' => 165, 'max' => 180],
            '18.5' => ['min' => 167, 'max' => 182],
            '19' => ['min' => 170, 'max' => 185],
            '19.5' => ['min' => 172, 'max' => 187],
            '20' => ['min' => 175, 'max' => 190],
            '20.5' => ['min' => 177, 'max' => 192],
            '21' => ['min' => 182, 'max' => 195],
            '21.5' => ['min' => 185, 'max' => 197],
            '22' => ['min' => 187, 'max' => 200],
            '22.5' => ['min' => 190, 'max' => 200],
            '23' => ['min' => 192, 'max' => 202],
            '23.5' => ['min' => 195, 'max' => 205],
            '24' => ['min' => 197, 'max' => 207],
            '24.5' => ['min' => 200, 'max' => 250],
            '25' => ['min' => 200, 'max' => 250],
            '25.5' => ['min' => 200, 'max' => 250],
            '26' => ['min' => 200, 'max' => 250],
            '27' => ['min' => 197, 'max' => 250],
        ],
    ];
}