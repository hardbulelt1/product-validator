<?php
/**
 * Class CompulsoryFiltersValidator
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Validator\Product;


use Validator\Message\ValidatorMessage;
use Validator\Models\Product\ProductInterface;
use Validator\Validator\Product\Contracts\ProductValidatorContract;
use Validator\Validator\Validator;

class CompulsoryFiltersValidator extends Validator implements ProductValidatorContract
{

    /**
     * @param ProductInterface $product
     * @return bool
     */
    public function validate(ProductInterface $product): bool
    {
        if (count($this->getMissingCompulsoryFilters($product)) !== 0) {
            $this->addMessage(new ValidatorMessage(ValidatorMessage::TYPE_ERROR,
                'Нет обязательных фильтров товара (бренд и/или год)'));
            return false;
        }
        return true;
    }

    /**
     * @param ProductInterface $product
     * @return array
     */
    private function getMissingCompulsoryFilters(ProductInterface $product): array
    {
        $missingCompulsoryFilters = [];
        if (!$product->hasFeature('brand')) {
            $missingCompulsoryFilters[] = 'brand';
        }
        if (!$product->hasFeature('year') && ($product->is_bike() || $product->isKickScooter())) {
            $missingCompulsoryFilters[] = 'year';
        }

        return $missingCompulsoryFilters;
    }
}