<?php
/**
 * Class AdditionFilterProcess
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */

namespace Validator\Process\AdditionFilter;

use Validator\Process\AbstractProcess;
use Validator\Process\Interfaces\ProcessInterface;
use Validator\Models\Product\ProductInterface;

class AdditionFilterProcess  implements ProcessInterface
{

    /**
     * @param ProductInterface $product
     */
    public function run(ProductInterface $product)
    {
        $sql = "SELECT tab1.code_1
            FROM (SELECT cf.feature_code as code_1, p.id AS pid
                  FROM products AS p INNER JOIN products_features AS pf
                      ON pf.product_id = p.id AND pf.feature_code = 'category'
                    INNER JOIN products_features_values AS pfv
                      ON pf.id = pfv.feature_id
                    INNER JOIN categories_features AS cf
                      ON cf.category_id = pfv.value_integer
                    INNER JOIN features AS f ON f.code = cf.feature_code
                  WHERE f.is_filterable = 1
                        AND p.id = :pid
                        AND f.type != 'custom'
                        AND f.is_for_product = 1
                        AND f.code NOT IN ('year', 'brand', 'color', 'wheel_size')
                 ) AS tab1 LEFT JOIN
              (SELECT pf.feature_code AS code_2
               FROM products AS p INNER JOIN products_features AS pf
                   ON pf.product_id = :pid
                 INNER JOIN features AS f ON f.code = pf.feature_code
                                             AND p.id = :pid
              ) AS tab2 ON tab1.code_1 = tab2.code_2
            WHERE tab2.code_2 IS NULL";
        $conn = $this->em->getConnection();
        $stmt = $conn->prepare($sql);
        if ($stmt->execute(['pid' => $product->getId()])) {
            $res = $stmt->fetchAll();
            if (count($res) > 0) {
                $product->setAdditionalFilterValid(false);
            } else {
                $product->setAdditionalFilterValid(true);
            }
        }
    }
}