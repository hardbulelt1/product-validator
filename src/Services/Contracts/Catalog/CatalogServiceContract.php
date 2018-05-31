<?php
/**
 * Class CatalogServiceContract
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Services\Contracts\Catalog;


interface CatalogServiceContract
{
    public function getMaxStock();
    public function getMaxViews();
    public function getMaxCart();
    public function getMaxComments();
    public function getMaxPrice();
    public function getMaxOwnStockPerCategory(int $categoryId);
    public function getMaxOwnStock();

}