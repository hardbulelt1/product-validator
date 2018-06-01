<?php
/**
 * Class SkuValidatorFactory
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Validator\Factory;


use Doctrine\Common\Collections\ArrayCollection;
use Validator\Validator\Contracts\Sku\SkuValidatorContract;
use Validator\Validator\Sku\CompulsoryFiltersValidator;
use Validator\Validator\Sku\FeaturesValidator;
use Validator\Validator\Sku\PriceValidator;

class SkuValidatorFactory
{
    private $validators = [];

    public function __construct()
    {
        $this->validators = new ArrayCollection();
    }

    public function make()
    {
        $this->makeCompulsoryFilters();
        $this->makePrice();
        $this->makeFeatures();
    }


    private function makeCompulsoryFilters()
    {
        $this->addValidator(new CompulsoryFiltersValidator());
    }

    private function makePrice()
    {
        $this->addValidator(new PriceValidator());
    }

    private function makeFeatures()
    {
        $this->addValidator(new FeaturesValidator());
    }

    /**
     * @return SkuValidatorContract[]
     */
    public function getValidators()
    {
        return $this->validators;
    }

    /**
     * @param SkuValidatorContract $skuValidatorContract
     */
    public function addValidator(SkuValidatorContract $skuValidatorContract)
    {
        $this->validators->add($skuValidatorContract);
    }

}