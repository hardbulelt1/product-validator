<?php
/**
 * Class SkuValidator
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Sku;
use Validator\Validator\Validator;

class SkuValidator extends Validator
{
    private $sku;
    private $is_valid;

    public function __construct(SkuInterface $sku)
    {
        $this->sku = $sku;
        $this->is_valid = true;
    }

    /**
     * @return bool
     */
    public function validate(): bool
    {
        if ($this->sku->getPriceCurrent() == 0 && $this->sku->getProduct()->getPriceVariable() == false) {
            $this->is_valid = false;
        }
        if ($this->sku->getProduct()->is_bike() && (!$this->sku->hasFeature('color') || !$this->sku->hasFeature('frame_size'))) {
            $this->is_valid = false;
        }
        if ($this->sku->getProduct()->isKickScooter() && !$this->sku->hasFeature('color')) {
            $this->is_valid = false;
        }

        $this->sku->setValid($this->is_valid);
    }

}