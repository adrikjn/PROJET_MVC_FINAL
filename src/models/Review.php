<?php
class Review extends Db
{
    public static function ajouterCommentaire(array $data)
    {
        $pdo = self::getDb();
        $requete = "INSERT INTO review (id_user, id_product, comment, created_at, rating) VALUES (:id_user, :id_product, :comment, :created_at, :rating)";
        $response = $pdo->prepare($requete);
        $response->execute($data);
        return $pdo->lastInsertId();
    }

    public static function findById(array $id)
    {
        // grace a la jointure je récupère tout les commentaire pour le produit et toute les infos du user de chaque commentaire
        $request="SELECT * FROM review INNER JOIN user ON review.id_user = user.id_user WHERE id_product=:id_product";
        $response = self::getDb()->prepare($request);
        $response->execute($id);
        return $response->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function mustLogin()
    {
    if(!$_SESSION['user'] && !empty($_POST));
    {
        $_SESSION['messages']['danger'] = "Veuillez vous connecter pour laisser un commentaire";
    }
    include(VIEWS . 'app/vueProduit.php');
    }
}