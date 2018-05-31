<?php
/**
 * Class TagRulesInterface
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */
namespace Validator\Models\Tag;

interface TagRulesInterface
{
    /**
     * @return mixed
     */
    public function getData();

    /**
     * @return mixed
     */
    public function getTagId();
}