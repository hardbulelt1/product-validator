<?php
/**
 * Class CompulsoryFiltersValidator
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Validator\Sku;


use Validator\Message\ValidatorMessage;
use Validator\Models\Sku\SkuInterface;
use Validator\Validator\Contracts\Sku\SkuValidatorContract;
use Validator\Validator\Validator;

class CompulsoryFiltersValidator extends Validator implements SkuValidatorContract
{

    /**
     * @param SkuInterface $sku
     * @return bool
     */
    public function validate(SkuInterface $sku): bool
    {
        if (count($this->getMissingSkuCompulsoryFilters($sku)) !== 0) {
            $this->addMessage(new ValidatorMessage(ValidatorMessage::TYPE_WARNING,
                'Есть СКУ с незаполненными обязательными фильтрами'));
            return false;
        }
        return true;
    }


    public function getMissingSkuCompulsoryFilters(SkuInterface $sku)
    {
        $missingCompulsoryFilters = [];
        if ($sku->getProduct()->is_bike() || $sku->getProduct()->isKickScooter()) {
            if (!in_array('color', $missingCompulsoryFilters) && !$sku->hasFeature('color')) {
                $missingCompulsoryFilters[] = 'color';
            }
            if (!in_array('frame_size',
                    $missingCompulsoryFilters) && $sku->getProduct()->is_bike() && !$sku->hasFeature('frame_size')) {
                $missingCompulsoryFilters[] = 'frame_size';
            }
        }

        return $missingCompulsoryFilters;
    }
}