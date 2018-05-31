<?php
/**
 * Class TagRulesService
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Services;


use Doctrine\ORM\EntityManager;
use Validator\Models\TagRules\TagRulesInterface;


class TagRulesService
{
    private $em;

    /**
     * TagRulesService constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return $this->em->getRepository(TagRulesInterface::class)->findAll();
    }
}