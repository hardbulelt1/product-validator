<?php
/**
 * Class FeatureInterface
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */
namespace Validator\Feature;

interface FeatureInterface
{
    public function getValue();

    public function getIsForProduct();

    public function getIsForSku();
}