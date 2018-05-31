<?php
/**
 * Class ProductFeatureInterface
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Models\Feature;


interface ProductFeatureInterface
{
    /**
     * @return mixed
     */
    public function getFeatureCode();

    /**
     * @return mixed
     */
    public function getValues();
}