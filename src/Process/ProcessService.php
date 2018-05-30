<?php
/**
 * Class ProcessService
 * @author: Denis Medvedevskih d.medvedevskih@velosite.ru
 */
namespace Validator\Process;
use Doctrine\ORM\EntityManager;
use Validator\Product\ProductInterface;
use Validator\Services\ProductTagger;

class ProcessService
{
    private $product;
    private $em;

    public function __construct(ProductInterface $product,EntityManager $entityManager)
    {
        $this->product = $product;
        $this->em = $entityManager;
    }

    public function processStock()
    {
        $stockTotal = 0;
        foreach ($this->product->getSku() as $sku) {
            if ($sku->isValid()) {
                $stockTotal += $sku->getTotalStock();
            }
        }
        $this->product->setStockTotal($stockTotal);
        $this->product->setFeatureValue('in_stock', $this->product->getStockTotal() > 0);
    }

    public function processPrice()
    {
        $priceCurrent = 0;
        $priceOld = 0;
        foreach ($this->product->getSku() as $sku) {
            if ($priceCurrent < $sku->getPriceCurrent()) {
                $priceCurrent = $sku->getPriceCurrent();
            }
            if ($priceOld < $sku->getPriceOld()) {
                $priceOld = $sku->getPriceOld();
            }
        }
        $this->product->setPriceCurrent($priceCurrent);
        $this->product->setPriceOld($priceOld);
        $this->product->setFeatureValue('is_sale', $this->product->getPriceOld() > $this->product->getPriceCurrent());
        $this->product->setHasPreOrder(
            $this->product->hasFeature('year') &&
            $this->product->getFeature('year')->getValue() == date('Y') &&
            $this->product->getStockTotal() == 0);
    }

    public function checkAdditionFilter()
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
        if ($stmt->execute(['pid' => $this->product->getId()])) {
            $res = $stmt->fetchAll();
            if (count($res) > 0) {
                $this->product->setAdditionalFilterValid(false);
            } else {
                $this->product->setAdditionalFilterValid(true);
            }
        }
    }

    public function processTags()
    {
        $tagRules = [];
        $productTagger = new ProductTagger($this->product, $tagRules);
        $tags = $productTagger->getTags();
        if ($this->product->hasFeature('tag')) {
            $this->product->deleteFeature('tag');
        }

        if (count($tags) > 0) {
            foreach ($tags as &$tag) {
                $tag = (int)$tag;
            }
            $tags = array_values(array_unique($tags));
            $this->product->setFeatureValue('tag', $tags);
        }
    }

    public function processCounters()
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
        $query->bindValue(':product_id', $this->product->id, \PDO::PARAM_INT);
        $query->bindValue(':date', $date, \PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(\PDO::FETCH_ASSOC);
        $this->product->setCartCount((int)$result['cart']);
        $this->product->setViewsCount((int)$result['views']);
    }

    public function processSorting()
    {

    }

    public function processGender()
    {

    }

    public function processStature()
    {

    }
}