<?php
/**
 * Class ProductValidatorFactory
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Validator\Factory;


use Doctrine\Common\Collections\ArrayCollection;
use Validator\Validator\Contracts\Product\ProductValidatorContract;
use Validator\Validator\Product\CategoriesValidator;
use Validator\Validator\Product\CodeValidator;
use Validator\Validator\Product\CompulsoryFiltersValidator;
use Validator\Validator\Product\DescriptionValidator;
use Validator\Validator\Product\Id1cValidator;
use Validator\Validator\Product\ImagesValidator;
use Validator\Validator\Product\ModelValidator;
use Validator\Validator\Product\PriceValidator;
use Validator\Validator\Product\SkuValidator;
use Validator\Validator\Product\TagLineValidator;

class ProductValidatorFactory
{
    private $validators = [];

    /**
     * ProductValidatorFactory constructor.
     */
    public function __construct()
    {
        $this->validators = new ArrayCollection();
    }

    /**
     * Make
     */
    public function make()
    {
        $this->makeCategories();
        $this->makeCode();
        $this->makeCompulsoryFilters();
        $this->makeDescription();
        $this->makeId1c();
        $this->makeImages();
        $this->makeModel();
        $this->makePrice();
        $this->makeSku();
        $this->makeTagLine();
    }

    /**
     * @return ProductValidatorContract[]
     */
    public function getValidators()
    {
        return $this->validators;
    }

    /**
     * @param ProductValidatorContract $productValidatorContract
     */
    public function addValidator(ProductValidatorContract $productValidatorContract)
    {
        $this->validators->add($productValidatorContract);
    }

    private function makeCategories()
    {
        $this->addValidator(new CategoriesValidator());
    }

    private function makeCode()
    {
        $this->addValidator(new CodeValidator());
    }

    private function makeCompulsoryFilters()
    {
        $this->addValidator(new CompulsoryFiltersValidator());
    }

    private function makeDescription()
    {
        $this->addValidator(new DescriptionValidator());
    }

    private function makeId1c()
    {
        $this->addValidator(new Id1cValidator());
    }

    private function makeImages()
    {
        $this->addValidator(new ImagesValidator());
    }

    private function makeModel()
    {
        $this->addValidator(new ModelValidator());
    }

    private function makePrice()
    {
        $this->addValidator(new PriceValidator());
    }

    private function makeSku()
    {
        $this->addValidator(new SkuValidator());
    }

    private function makeTagLine()
    {
        $this->addValidator(new TagLineValidator());
    }
}