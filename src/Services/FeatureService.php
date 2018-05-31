<?php
/**
 * Class FeatureService
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Services;


use Doctrine\ORM\EntityManager;
use Validator\Feature\FeatureInterface;

class FeatureService
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param $code
     * @return FeatureInterface
     */
    public function getByCode($code)
    {
        return $this->em->getRepository(FeatureInterface::class)->findBy(['code' => $code]);
    }
}