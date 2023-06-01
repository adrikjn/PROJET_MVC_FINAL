<?php 

class Buy extends Db
{
    public static function addBuy(array $data)
    {
        $pdo = self::getDb();
        $request = "INSERT INTO buy (id_purchase, id_product, quantity) VALUES (:id_purchase, :id_product, :quantity)"; 
        $response = $pdo->prepare($request);
        $response->execute($data);
        return $pdo->lastInsertId();
    
    
    }

    public static function findAll()
    {
        $pdo = self::getDb();
        $response = $pdo->prepare("SELECT * FROM buy INNER JOIN product ON buy.id_product = product.id_product");
        $response->execute();
        return $response->fetchAll(PDO::FETCH_ASSOC);

    }

}

?>