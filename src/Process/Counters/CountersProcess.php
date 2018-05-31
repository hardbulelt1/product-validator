<?php
/**
 * Class CountersProcess
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Process\Counters;


use Validator\Process\AbstractProcess;
use Validator\Process\Interfaces\ProcessInterface;
use Validator\Product\ProductInterface;

class CountersProcess extends AbstractProcess implements ProcessInterface
{
    /**
     * @param ProductInterface $product
     */
    public function run(ProductInterface $product)
    {
        $connection = $this->em->getConnection();
        $queryString = "
            SELECT 
              SUM(cart) AS cart, 
              SUM(views) AS views 
            FROM products_counters
            WHERE product_id = :product_id
            AND dt > :date
        ";
        $query = $connection->prepare($queryString);
        $date = date('Y-m-d', time() - 2 * 7 * 24 * 3600);
        $query->bindValue(':product_id', $product->getId(), \PDO::PARAM_INT);
        $query->bindValue(':date', $date, \PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(\PDO::FETCH_ASSOC);
        $product->setCartCount((int)$result['cart']);
        $product->setViewsCount((int)$result['views']);
    }
}