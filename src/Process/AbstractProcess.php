<?php
/**
 * Class AbstractProcess
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Process;


use Doctrine\ORM\EntityManager;

abstract class AbstractProcess
{
    protected $em;

    /**
     * AbstractProcess constructor.
     * @param EntityManager $entityManager
     */
    final public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }
}