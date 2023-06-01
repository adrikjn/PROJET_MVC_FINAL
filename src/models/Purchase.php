<?php 

class Purchase extends Db
{
    public static function addOrder(array $data)
    {
        $pdo = self::getDb();
        $request = "INSERT INTO purchase (id_user, purchase_date, total, status) VALUES (:id_user, :purchase_date, :total, 'En cours de traitement')";
        $response = $pdo->prepare($request);
        $response->execute($data);
        return $pdo->lastInsertId();

    } 

    public static function allOrderByUser($id)
    {
        $request = "SELECT * FROM purchase WHERE id_user = :id_user";
        $response = self::getDb()->prepare($request);
        $response->execute($id);
        return $response->fetchAll(PDO::FETCH_ASSOC);

    }
}





?>