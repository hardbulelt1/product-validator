<?php
/**
 * Class TagRulesServiceContract
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Services\Contracts\Tag;



use Validator\Models\Tag\TagRulesInterface;

interface TagRulesServiceContract
{
    /**
     * @return TagRulesInterface[]
     */
    public function findAll();
}