<?php

class AppController
{


    public static function index()
    {
        $produits = Product::findAll();
        include(VIEWS . 'app/index.php');
    }

    
    public static function vueProduit()
    {
        $produits = Category::productJoinCategory1();
        if(isset($_GET['id']))
        {   
            //*techniquement $_GET['id'] est un string si on veut être rigoureux on convertit se string en integer dans notre tableau car l'id est un int
            // echo gettype($_GET['id']);
            $produit = Product::findById([
                'id_product' => intval($_GET['id'])
            ]);
            $comments = Review::findById(['id_product' => $_GET['id']]);
        }
        include(VIEWS . 'app/vueProduit.php');
    }

    public static function addCart()
    {
       // on vérifie qu'on a bien l'id dans l'url de notre produit 
       if(!empty($_GET['id']))
       {   
            Cart::add($_GET['id']);
            // if(empty($_SESSION['panier'][$id]))
            // {
            //     $_SESSION['panier'][$id] = 1;
            // }
            // else
            // {
            //     $_SESSION['panier'][$id]++;
            // }

       }
       //vérifie qu'il y a le paramètre page en GET
       if(!empty($_GET['page']))
       {
        //je stock dans la variable $page la valeur de $_GET['page']
        $page = $_GET['page'];

        //en fonction de la valeur de $page on fait sa redirection
        switch($page)
        {
            case 'accueil':
                header('location:' . BASE );
                exit;
                break;
            case 'panier':
                header('location:' . BASE . 'cart/view');
                exit;
                break;
        }
       }
      
       
        header('location:' . BASE );
        exit;
       
       
    
    
    }

    public static function viewCart()
    {
    $detailPanier = Cart::getDetailPanier();
    $totalPanier = Cart::getTotal();
       
    
    
     include(VIEWS."app/panier.php" ) ;
    }

    public static function substractCart()
    {
       if(!empty($_GET['id']))
       {    
            Cart::substract($_GET['id']);

       }

       header('location:' . BASE . 'cart/view');
       exit;
    
    
     
    }

    public static function removeCart()
    {
       
        $panier = $_SESSION['panier'];

        if(!empty($_GET['id']))
        {
            $id = $_GET['id'];
            
            unset($panier[$id]);
        }

        $_SESSION['panier'] = $panier;

        header("location:" . BASE . 'cart/view');
        exit;
    
     
    }

    public static function deleteCart()
    {
       
        unset($_SESSION['panier']);
        header('location:' .  BASE .'cart/view' );
        exit;
     
    }

    public static function viewProfil()
    {
        $user = $_SESSION['user'];
        //$user = User::findUserProfil($id_user);
        $orders = Purchase::allOrderByUser(['id_user' => $user['id_user']]);
        $buys = Buy::findAll(); 

        if (!empty($_POST['pseudo'])) {

            User::modifierPseudo([
                'pseudo' => htmlentities($_POST['pseudo']),
                'id_user' => $_SESSION['user']['id_user']
            ]);

            $_SESSION['messages']['success'][] = "Vous avez maintenant le pseudo: " . $_POST['pseudo'];

            $_SESSION['user']['pseudo'] = htmlentities($_POST['pseudo']);
        }

        //on vérifie que le formulaire est envoyé
        if (!empty($_POST['password'])) {
            //on stock le potentiel utilisateur trouvé dans la BDD à l'aide de son email
            $user = $_SESSION['user'];

            //si un utilisateur en BDD a bien l'email taper dans l'input (si la variable $user n'est pas vide)
            if ($user) {
                // die(var_dump($user));
                //on vérifie que le mot de passe tapé par l'utilisateur correspond au mdp dans la BDD pour l'email donné
                if (password_verify($_POST['password'], $user['password'])) {
                    User::modifierPassword([
                        'password' => password_hash($_POST['newPassword'], PASSWORD_DEFAULT),
                        'id_user' => $_SESSION['user']['id_user'],
                    ]);
                    $_SESSION['messages']['success'][] = "Vous avez changé votre mot de passe !";
                } else {

                    $_SESSION['messages']['danger'][] = "Erreur sur le mot de passe";
                }
            }
        }


        include(VIEWS . "app/profil.php");
    }

    public static function deleteAccount()
    {
        User::deleteAccount([
            'id_user' => $_SESSION['user']['id_user']
        ]);
        header('location:' .  BASE . 'logout');
        exit;
    }

    public static function verifyPassword()
    {
        //on vérifie que le formulaire est envoyé
        if (!empty($_POST)) {
            //on stock le potentiel utilisateur trouvé dans la BDD à l'aide de son email
            $user = $_SESSION['user'];

            //si un utilisateur en BDD a bien l'email taper dans l'input (si la variable $user n'est pas vide)
            if ($user) {
                // die(var_dump($user));
                //on vérifie que le mot de passe tapé par l'utilisateur correspond au mdp dans la BDD pour l'email donné
                if (password_verify($_POST['password'], $user['password'])) {
                    header('location:' . BASE);
                    exit;
                } else {

                    $_SESSION['messages']['danger'][] = "Erreur sur le mot de passe";
                }
            }
        }

        include(VIEWS . 'app/profil.php');
    }

    public static function finaliserCommande()
    {
      if(!empty($_SESSION['user']['delivery_address']) && !empty($_SESSION['user']['billing_address']) ) 
      {
        include(VIEWS."app/finaliser.php" ) ;
      }else
      {
        header('location:' . BASE . 'commande/formulaire');
        
        exit;
      }
    }

    public static function ajoutAdresse()
    {
        if(!empty($_POST))
        {
            $error = [];
            if(empty($_POST["delivery_address"]))
            {
                $error['delivery_address'] = "le champs est obligatoire";
            }
            if(empty($_POST['billing_address']))
            {
                $error['billing_address'] = "le champs  est obligatoire";
            }

            if(!$error)
            {
                $data = [
                    'delivery_address' => $_POST['delivery_address'],
                    'billing_address' => $_POST['billing_address'],
                    'id_user' => $_SESSION['user']['id_user']
       
                ];
                User::addAddress($data);
                $_SESSION['user'] = User::findByEmail(['email' => $_SESSION['user']['email']]);
                $_SESSION['messages']['success'][] = 'L\'adresse a bien été ajouté';
                header('location:' . BASE);
                exit();
            }
    
        }
        include(VIEWS . 'app/ajoutAdresse.php');

    }

    public static function createOrder() 
    {
        $purchase = Purchase::addOrder([
            'id_user'=> $_SESSION['user']['id_user'],
            'purchase_date'=> date_format(new DateTime(), 'Y-m-d H:i:s'),
            'total'=> Cart::getTotal(),
        ]);
        $panier = $_SESSION['panier'];
        foreach ($panier as $id => $quantity){
            $buy = Buy::addBuy([
                'id_purchase' => $purchase, 
                'id_product' => $id, 
                'quantity' => $quantity, 
            ]);
        }

        unset($_SESSION['panier']);
        $_SESSION['messages']['success'][] = "Votre commande a bien été reçue";
        header('location:' . BASE );
        exit;
    
    }

    


}
