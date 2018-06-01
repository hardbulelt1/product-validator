<?php
/**
 * Class FeaturesValidator
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Validator\Sku;


use Validator\Message\ValidatorMessage;
use Validator\Models\Sku\SkuInterface;
use Validator\Validator\Validator;

class FeaturesValidator extends Validator implements SkuValidatorContract
{

    /**
     * @param SkuInterface $sku
     * @return bool
     */
    public function validate(SkuInterface $sku): bool
    {
        $valid = true;
        if ($sku->getProduct()->is_bike() && (!$sku->hasFeature('color') || !$sku->hasFeature('frame_size'))) {
            $this->addMessage(new ValidatorMessage(ValidatorMessage::TYPE_ERROR, 'Нет frame_size'));
            $valid = false;
        }
        if ($sku->getProduct()->isKickScooter() && !$sku->hasFeature('color')) {
            $this->addMessage(new ValidatorMessage(ValidatorMessage::TYPE_ERROR, 'Нет color'));
            $valid = false;
        }

        return $valid;
    }
}