<?php 

class Category extends Db
{

    public static function addCategory(array $data)
    {
        $pdo= self::getDb();
        $request = "INSERT INTO category (name) VALUES (:name)";
        $response = $pdo->prepare($request);
        $response->execute($data);
        return $pdo->lastInsertId();
    }
    
    public static function findAllCategory()
    {
        $request="SELECT * FROM category";
        $response = self::getDb()->prepare($request);
        $response->execute();

        return $response->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function deleteCategory(array $id)
    {
        $request="DELETE FROM category WHERE id_category = :id_category";
        $response = self::getDb()->prepare($request);
        return $response->execute($id);
    }

    public static function findByName(array $categorie)
    {
        $request="SELECT * FROM category WHERE name=:name";
        $response = self::getDb()->prepare($request);
        $response->execute($categorie);
        return $response->fetch(PDO::FETCH_ASSOC);
    }

    public static function updateCategory(array $francisco)
    {
        $request="UPDATE category SET name=:name WHERE id_category =:id_category";
        $response = self::getDb()->prepare($request);
        return $response->execute($francisco);

    }

    public static function findByIdCategory(array $id)
    {
        $request="SELECT * FROM category WHERE id_category=:id_category";
        $response = self::getDb()->prepare($request);
        $response->execute($id);
        return $response->fetch(PDO::FETCH_ASSOC);
    } 

    public static function productJoinCategory()
    {
        //on fait un left join pour récupérer tout les produits meme ceux qui n'ont pas de categorie
       $request = "SELECT id_product, p.name, price, image, c.name as category
       FROM product p
       LEFT JOIN category c ON c.id_category = p.id_category";
        $response = self::getDb()->prepare($request);
        $response->execute();
        return $response->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function productJoinCategory1()
    {
       $request = "SELECT id_product, p.name, price, image, c.name as category
       FROM product p
       INNER JOIN category c ON c.id_category = p.id_category";
        $response = self::getDb()->prepare($request);
        $response->execute();
        return $response->fetch(PDO::FETCH_ASSOC);
    }


        
}



// SELECT * FROM product INNER JOIN category ON product.category = category.name;
// Un truc comme ça je pense pour afficher les produits que contiennent les catégorie
