<?php
/**
 * Class ProductValidator
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */
namespace Validator\Validator;
use Validator\Product\Message\ValidatorMessage;
use Validator\Product\ProductInterface;


class ProductValidator extends Validator
{
    private $product;
    private $isValid;

    public function __construct(ProductInterface $product)
    {
        $this->product = $product;
        $this->isValid = true;
    }

    /**
     * @return bool
     */
    public function validate(): bool
    {
        $this->validatePrice();
        $this->validateImages();
        $this->validateSku();
        $this->hasMissingSkuCompulsoryFilters();
        $this->validateModel();
        $this->validateCode();
        $this->validateCategories();
        $this->hasMissingCompulsoryFilters();
        $this->validateId1c();
        $this->validateDescription();
        $this->validateTagLine();

        return $this->isValid;
    }



    /**
     * @return bool
     */
    private function validatePrice(): bool
    {
        if ($this->product->getPriceCurrent() == 0 && !$this->product->getPriceVariable()) {
            $this->addMessage(new ValidatorMessage(ValidatorMessage::TYPE_ERROR, 'Нет цены'));
            $this->isValid = false;
        }
        return $this->isValid;
    }

    /**
     * @return bool
     */
    private function validateImages(): bool
    {
        if (!$this->product->isOfType(ProductInterface::TYPE_WORKSHOP_SERVICE) && (count($this->product->getPictures()) == 0)) {
            $this->addMessage(new ValidatorMessage(ValidatorMessage::TYPE_ERROR,
                'Нет ни однйо картинки'));
            $this->isValid = false;
        }
        return $this->isValid;
    }

    /**
     * @return bool
     */
    private function validateSku(): bool
    {
        if (count($this->product->getSku()) == 0) {
            $this->addMessage(new ValidatorMessage(ValidatorMessage::TYPE_ERROR, 'Нет ни одного СКУ'));
            $this->isValid = false;
        }
        if ($this->hasNoValidSku()) {
            $this->addMessage(new ValidatorMessage(ValidatorMessage::TYPE_ERROR,
                'Нет ни одного валидного СКУ (с ценой и всеми фильтрами)'));
            $this->isValid = false;
        }

        return $this->isValid;
    }

    /**
     * @return bool
     */
    private function validateModel(): bool
    {
        if (!$this->product->getModel()) {
            $this->addMessage(new ValidatorMessage(ValidatorMessage::TYPE_ERROR, 'Нет названия модели'));
            $this->isValid = false;
        }
        return $this->isValid;
    }

    /**
     * @return bool
     */
    private function validateCode(): bool
    {
        if (!$this->product->getCode()) {
            $this->addMessage(new ValidatorMessage(ValidatorMessage::TYPE_ERROR, 'Нет кода товара'));
            $this->isValid = false;
        }
        return $this->isValid;
    }

    /**
     * @return bool
     */
    private function validateCategories(): bool
    {
        if (count($this->product->get_categories()) == 0) {
            $this->addMessage(new ValidatorMessage(ValidatorMessage::TYPE_ERROR,
                'Нет ни одной категории'));
            $this->isValid = false;
        }

        return $this->isValid;
    }

    /**
     * @return bool
     */
    private function validateId1c(): bool
    {
        if (!$this->product->getId1c()) {
            $this->addMessage(new ValidatorMessage(ValidatorMessage::TYPE_ERROR, 'Не указан ID 1C'));
            $this->isValid = false;
        }
        return $this->isValid;
    }

    /**
     * @return bool
     */
    private function validateDescription(): bool
    {
        if (!$this->product->get_description()) {
            $this->addMessage(new ValidatorMessage(ValidatorMessage::TYPE_WARNING, 'Нет описания'));
        }
        return $this->isValid;
    }

    /**
     * @return bool
     */
    private function validateTagLine(): bool
    {
        if (!$this->product->get_tag_line()) {
            $this->addMessage(new ValidatorMessage(ValidatorMessage::TYPE_WARNING, 'Нет тэглайна'));
        }
        return $this->isValid;
    }

    /**
     * @return bool
     */
    public function hasMissingCompulsoryFilters()
    {
        if (count($this->getMissingCompulsoryFilters()) !== 0) {
            $this->isValid = false;
            $this->addMessage(new ValidatorMessage(ValidatorMessage::TYPE_ERROR,
                'Нет обязательных фильтров товара (бренд и/или год)'));

        }
        return $this->isValid;
    }

    /**
     * @return bool
     */
    public function hasMissingSkuCompulsoryFilters()
    {

        if (count($this->getMissingSkuCompulsoryFilters()) !== 0) {
            $this->isValid = false;
            $this->addMessage(new ValidatorMessage(ValidatorMessage::TYPE_WARNING,
                'Есть СКУ с незаполненными обязательными фильтрами'));

        }
        return $this->isValid;
    }

//    /**
//     * @return bool
//     */
//    public function hasMissingAdditionalFilters()
//    {
//        return count($this->getMissingAdditionalFilters()) !== 0;
//    }

//    /**
//     * Возвращает коды дополнительных фильтров, которых нет у товара
//     * @return array
//     */
//    public function getMissingAdditionalFilters()
//    {
//        $missingAdditionalFilters = [];
//
//        /** @var \Velosite\References\Feature $featureReference */
//        $featureReference = Di::getDefault()->getShared('featureReference');
//        /** @var \Velosite\References\Category $categoryReference */
//        $categoryReference = Di::getDefault()->getShared('categoryReference');
//
//
//        $availableFilters = array_reduce($this->product->get_categories(),
//            function ($carry, $categoryId) use ($categoryReference, $featureReference) {
//                if ($categoryId == 1) {
//                    return $carry;
//                }
//                $category = $categoryReference->getById($categoryId);
//                foreach ($category->getFilters() as $filter_code) {
//                    if (!in_array($filter_code, $carry) && $featureReference->exists($filter_code) && $featureReference->getByCode($filter_code)->isFilterable) {
//                        $carry[] = $filter_code;
//                    }
//                }
//
//                return $carry;
//            }, []);
//
//
//        foreach ($availableFilters as $featureCode) {
//            if (!$this->product->hasFeature($featureCode) &&
//                !in_array($featureCode, ['gender', 'color', 'frame_size', 'stature', 'price', 'age', 'is_recommended', 'is_hit']) &&
//                !in_array($featureCode, $missingAdditionalFilters)
//                && is_string($featureCode) &&
//                strlen($featureCode) > 0
//            ) {
//                $missingAdditionalFilters[] = $featureCode;
//            }
//        }
//
//        return $missingAdditionalFilters;
//    }

    /**
     * Возвращает коды обязательныхъ к наличию фильтров у СКУ
     * Код фильтра будет возвращён, если хотя бы у одного СКУ данного товара нет обязательног фильтра
     * @return array
     */
    public function getMissingSkuCompulsoryFilters()
    {
        $missingCompulsoryFilters = [];
        if ($this->product->is_bike() || $this->product->isKickScooter()) {
            foreach ($this->product->getSku() as $sku) {
                if (!in_array('color', $missingCompulsoryFilters) && !$sku->hasFeature('color')) {
                    $missingCompulsoryFilters[] = 'color';
                }
                if (!in_array('frame_size',
                        $missingCompulsoryFilters) && $this->product->is_bike() && !$sku->hasFeature('frame_size')) {
                    $missingCompulsoryFilters[] = 'frame_size';
                }
            }
        }

        return $missingCompulsoryFilters;
    }


    public function getMissingCompulsoryFilters()
    {
        $missingCompulsoryFilters = [];
        if (!$this->product->hasFeature('brand')) {
            $missingCompulsoryFilters[] = 'brand';
        }
        if (!$this->product->hasFeature('year') && ($this->product->is_bike() || $this->product->isKickScooter())) {
            $missingCompulsoryFilters[] = 'year';
        }

        return $missingCompulsoryFilters;
    }

    public function hasNoValidSku()
    {
        $hasValidSku = false;
        foreach ($this->product->getSku() as $sku) {
            if ($sku->isValid()) {
                $hasValidSku = true;
                break;
            }
        }

        return !$hasValidSku;
    }



}