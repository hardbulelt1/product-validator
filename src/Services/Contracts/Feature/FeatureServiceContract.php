<?php
/**
 * Class FeatureServiceContract
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Services\Contracts\Feature;


use Validator\Models\Feature\FeatureInterface;

interface FeatureServiceContract
{
    /**
     * @param $code
     * @return FeatureInterface
     */
    public function getByCode($code);
}