<?php

class AdminController
{
    public static function ajoutProduit()
    {   
        $categories = Category::findAllCategory();
        
        //on vérifie que l'utilisateur n'est pas connecté ou qu'il est connecté mais n'est pas admin
        if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != "ROLE_ADMIN")
        {
            //dans ce cas on le renvoie a l'accueil
            header('location:' . BASE);
            exit;
        }

        //*on vérifie que l'utilisateur a cliqué sur le bouton submit.
        if(!empty($_POST))
        {
            //*on créé un tableau vide qui va servir a gerer nos erreurs
            $error = [];
            //*on vérifie que l'input "name" est vide et dans se cas on ajoute un message d'erreur dans le tableau $error (indice 'name')
            if(empty($_POST["name"]))
            {
                $error['name'] = "le champs name est obligatoire";
            }
            if(empty($_POST['description']))
            {
                $error['description'] = "le champs description est obligatoire";
            }
            if(empty($_POST['price']))
            {
                $error['price'] = "le champs price est obligatoire";
            }
            //*on vérifie l'input type file
            if(empty($_FILES['image']['name']))
            {
                $error['image'] = "le champs image est obligatoire";
            }
            //* s'il n'y a pas d'erreur on peut traiter l'image et envoyer les données en bdd
            if(!$error)
            {   
            //*on vérifie la taille du fichier et si ce fichier est une image
               if($_FILES['image']['size'] < 3000000 && ($_FILES['image']['type'] == 'image/jpeg'|| $_FILES['image']['type'] == 'image/png' || $_FILES['image']['type'] == 'image/gif' || $_FILES['image']['type'] == 'image/webp' ))
               {
                //*on créer un nouveau name pour l'image (unique)
                  $nameImage = date('dmYHis') . $_FILES['image']['name'];

                //   die(var_dump($_FILES['image']['tmp_name'], PUBLIC_FOLDER . DIRECTORY_SEPARATOR . "upload". DIRECTORY_SEPARATOR . $nameImage));
                //*on a copier le fichier stocker de manière temporaire dans le dossier upload avec son nouveau name
                  copy($_FILES['image']['tmp_name'], PUBLIC_FOLDER . DIRECTORY_SEPARATOR . "upload". DIRECTORY_SEPARATOR . $nameImage);
                
                 //*créer un tableau de donnée avec les données a envoyer en BDD 
                  $data = [
                    'name' => $_POST['name'],
                    'category' => $_POST['id_category'],
                    'image' => $nameImage,
                    'price' => $_POST['price'],
                    'description' => $_POST['description']
                  ];
                 //*on utilise la méthode ajouter (static) de la class Produit afin d'envoyer mes données en BDD 
                 Product::ajouter($data);
                 
                 $_SESSION['messages']['success'][] = 'Le produit a bien été ajouté';
                 header('location:' . BASE);
                 exit(); 
               }
            }

        }
         
        include(VIEWS . 'admin/ajoutProduit.php' );
    }

    public static function gestionProduit()
    {
        Verif::admin();
        $produits = Category::productJoinCategory();
        include(VIEWS . 'admin/gestionProduit.php');
    }

    public static function modifierProduit()
    {   
        Verif::admin();
        $categories = Category::findAllCategory();
        //*ici on vérifier que notre GET['id'] n'est pas vide afin de récupérer notre produit
        if(!empty($_GET['id'])){
            //*je récupère mon produit grâce a son id
            $produit = Product::findById(['id_product' => $_GET['id']]);
        }
        else{
            header('location:' . BASE . 'produit/gestion');
            exit();
        }
        //*si l'utilisateur a cliqué sur modifier alors je rentre dans les accolades
        if(!empty($_POST))
        {
            //*création d'un tableau d'erreur vide
            $error = [];
            foreach($_POST as $indice => $valeur)
            {
                if(empty($valeur))
                {
                    $error[$indice] = "le champs $indice est obligatoire";
                }
            }
            //* s'il y a pas d'erreur on fait notre traitement
                if(!$error)
                {
                    //*on vérifie qu'il y a une nouvelle image dans l'input type file avec le bon poid et le bon type
                    if((!empty($_FILES['image']['name'])) && $_FILES['image']['size'] < 3000000 && ($_FILES['image']['type'] == 'image/jpeg'|| $_FILES['image']['type'] == 'image/png' || $_FILES['image']['type'] == 'image/gif' || $_FILES['image']['type'] == 'image/webp' ))
                    {
                        //*on créé un nouveau name d'image
                        $nameImage = date("dmYHis") . $_FILES['image']['name'];
                        
                        //*on supprime l'ancienne image 
                        unlink(PUBLIC_FOLDER . 'upload' . DIRECTORY_SEPARATOR . $_POST['ancienneImg']);

                        //*on stocke la nouvelle image
                        copy($_FILES['image']['tmp_name'], PUBLIC_FOLDER . 'upload' . DIRECTORY_SEPARATOR . $nameImage);
                    }
                    //*s'il n'y a pas de nouvelle
                    else
                    {   //* on stocke dans la variable $nameImage le name de l'ancienne image
                        $nameImage = $_POST['ancienneImg'];
                    }
                    //*on procède à la modification en BDD de notre produit
                    Product::update([
                        'name' => $_POST['name'],
                        'category' => $_POST['id_category'],
                        'image' => $nameImage,
                        'price' => $_POST['price'],
                        'description' => $_POST['description'],
                        'id_product' => $_GET['id']
                    ]);
                    $_SESSION['messages']['success'][] = 'Le produit a bien été modifié';

                    header('location:' . BASE . 'produit/gestion');
                    exit();
                }
            

        }
        include(VIEWS . 'admin/modifierProduit.php');
    }

    public static function supprimerProduit()
    {
        Verif::admin();
        if(!empty($_GET['id']))
        {
            Product::delete([
                'id_product' => $_GET['id']
            ]);
            $_SESSION['messages']['success'][] = 'Le produit a bien été supprimé';
        }

        header('location:' . BASE . 'produit/gestion');
        exit;
    }

    public static function gestionUser()
    {
       
    
    Verif::admin();
    $users = User::findAll();
     include(VIEWS."admin/gestionUser.php" ) ;
    }

    public static function supprimerUser()
    {
       Verif::admin();
       if(!empty($_GET['id']))
       {
            die(var_dump($_GET));
           User::delete(['id_user' => $_GET['id']]); 
           $_SESSION['messages']['success'][] = "L'utilisateur a bien été supprimé!!!";
       }

       header('location:' . BASE . 'user/gestion');
       exit;
    
    
    }


    public static function modifierRole()
    {
        Verif::admin();
        if(!empty($_GET['id']) && !empty($_GET['role']))
        {
            if($_GET['role'] == "ROLE_USER")
            {
                $role = "ROLE_ADMIN";
            }else
            {
                $role ="ROLE_USER";
            }

            User::modifierRole([
                'role' => $role,
                'id_user' => $_GET['id']
            ]);

            $_SESSION['messages']['success'][] ="l'utilisateur d'id $_GET[id] a maintenant le role : $role";

            header("location:" . BASE . 'user/gestion');
            exit;


        }
    
     
    }

    public static function addCategory()
    {
        Verif::admin();
        
        if (!empty($_POST)) {
            $findName = Category::findByName(['name' => $_POST['name']]);
            $error = [];
            if (empty($_POST['name'])) {
                $error['name'] = "le champs name est obligatoire";
            } elseif (!$findName) {

                Category::addCategory(['name' => $_POST['name']]);

                $_SESSION['messages']['success'][] = 'La catégorie a bien été ajouté';

                header('location:' . BASE . 'produit/gestioncategory');
                exit();
            } else {
                $_SESSION['messages']['danger'][] = 'La catégorie choisie existe déjà sur le site, veuillez entrez un nom différent !';
            }
        }

        include(VIEWS . "admin/ajoutCategorie.php");
    }


    


    public static function gestionCategory()
    {
        Verif::admin();
        $categories = Category::findAllCategory();
    
        include(VIEWS."admin/gestionCategorie.php" ) ;
    }

    public static function deleteCategory()
    {
        if(!empty($_GET['id']))
        {
            Category::deleteCategory([
                'id_category' => $_GET['id']
            ]);
            $_SESSION['messages']['success'][] = 'La Catégorie a bien été supprimé';
        }
    
        header('location:' . BASE . 'produit/gestioncategory');
        exit;
    }

    public static function modifierCategory()
    {
        //*ici on vérifier que notre GET['id'] n'est pas vide afin de récupérer notre produit
        if(!empty($_GET['id'])){
            //*je récupère mon produit grâce a son id
            $category = Category::findByIdCategory(['id_category' => $_GET['id']]);
        }
        else{
            header('location:' . BASE . 'produit/gestioncategory');
            exit();
        }
        //*si l'utilisateur a cliqué sur modifier alors je rentre dans les accolades
        if(!empty($_POST))
        {
            //*création d'un tableau d'erreur vide
            $error = [];
            foreach($_POST as $indice => $valeur)
            {
                if(empty($valeur))
                {
                    $error[$indice] = "le champs $indice est obligatoire";
                }
            }
            //* s'il y a pas d'erreur on fait notre traitement
                if(!$error)
                {
                    
                    Category::updateCategory([
                        'name' => $_POST['name'],
                        'id_category' => $_GET['id']
                    ]);
                    $_SESSION['messages']['success'][] = 'La Catégorie a bien été modifié';

                    header('location:' . BASE . 'produit/gestioncategory');
                    exit();
                }
            

        }
    
     include(VIEWS."admin/modifierCategorie.php" ) ;
    }

}