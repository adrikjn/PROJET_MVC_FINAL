<?php


class SecurityController
{

    public static function inscription()
    {
        //vérifie que le formulaire est submit
        if(!empty($_POST))
        {
            //on initialise notre tableau d'erreur
            $error = [];

            //fonction permettant de vérifier la conformiter du mot de passe
            function valid_pass($candidate)
            {
                $r1 = '/[A-Z]/';  //Uppercase
                $r2 = '/[a-z]/';  //lowercase
                $r3 = '/[!@#$%^&*()\-_=+{};:,<.>]/';  // whatever you mean by 'special char'
                $r4 = '/[0-9]/';  //numbers
                
            //     if (preg_match_all($r1, $candidate, $o) < 1) return FALSE;

            //    if (preg_match_all($r2, $candidate, $o) < 1) return FALSE;

            //     if (preg_match_all($r3, $candidate, $o) < 1) return FALSE;

            //     if (preg_match_all($r4, $candidate, $o) < 1) return FALSE;

            //    if (strlen($candidate) < 5) return FALSE;

                return TRUE;
            }

            //effectuer les différent control des inputs du formulaire d'inscription
            if(empty($_POST['f_name']) || preg_match('#[0-9]#', $_POST['f_name']))
            {
                $error['f_name'] = "le champs est obligatoire et doit contenir uniquement des lettres";
            }
            if(empty($_POST['l_name']) || preg_match('#[0-9]#', $_POST['l_name']))
            {
                $error['l_name'] = "le champs est obligatoire et doit contenir uniquement des lettres";
            }
            if(empty($_POST['pseudo']))
            {
                $error['pseudo'] = 'le champs est obligatoire';
            }
            //on vérifie que l'email soit valide(@ et .quelqueschoses) et  que l'email existe en bdd 
            if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || User::findByEmail(['email' => $_POST['email']]) )
            {
                //si l'email existe deja en bdd 
                if(User::findByEmail(['email' => $_POST['email']]))
                {
                    $_SESSION['messages']['danger'][] = 'Un compte est déjà existant à cette adresse email, veuillez procéder à la récupération du mot de passe';
                    $error['email'] = "";
                }
                else
                {
                    $error['email'] = "le champs email est obligatoire et l'adresse email doit être valide";
                }
            }
            //vérifie que le patern pour le mdp n'a pas été respecter, pas de majuscule ou pas minuscule ou pas de chiffre ou pas de caractère spécial ou mot de passe trop court
            if(empty($_POST['password']) || !valid_pass($_POST['password']) )
            {
                $error['password'] = "Le champs est obligatoire et votre mot de passe doit contenir : <ul><li>une majuscule</li><li>minuscule</li> <li>un chiffre</li> <li>un caratère spécial</li> <li>doit faire plus de 4 caractères</li></ul>";
            }
            //si les mots de passes sont différents
            if(empty($_POST['checkPwd']) || $_POST['password'] != $_POST['checkPwd'])
            {
                $error['checkPwd'] = "Le champs est obligatoire et les mots de passe doivent concorder";
            }

            //si notre tableau d'erreur est rester vide (donc si on a aucune erreur)
            if(!$error)
            {
                //on hash le mot de passe
                $mdp = password_hash($_POST['password'], PASSWORD_DEFAULT);

                //on envoie les infos en BDD
                User::ajouter([
                   'f_name' => $_POST['f_name'],
                   'l_name' => $_POST['l_name'],
                   'pseudo' => $_POST['pseudo'],
                   'email' => $_POST['email'],
                   'password' => $mdp
                ]);

                $_SESSION['messages']['success'][] = "Félicitation, vous êtes à présent inscrit. Connectez-vouz!!!";
                header("location:" . BASE);
                exit;
            }
        }
        include(VIEWS . 'security/inscription.php');
    }

    public static function login()
    {
        //on vérifie que le formulaire est envoyé
        if(!empty($_POST))
        {
            //on stock le potentiel utilisateur trouvé dans la BDD à l'aide de son email
            $user = User::findByEmail(['email' => $_POST['email']]);

            //si un utilisateur en BDD a bien l'email taper dans l'input (si la variable $user n'est pas vide)
            if($user)
            {
                // die(var_dump($user));
                //on vérifie que le mot de passe tapé par l'utilisateur correspond au mdp dans la BDD pour l'email donné
                if(password_verify($_POST['password'], $user['password']))
                {
                    //on stock le user dans la SESSION à l'indice 'user'(= connecter l'utilisateur)
                   $_SESSION['user'] = $user;

                   $_SESSION['messages']['success'][] = "Bienvenue " . $user['pseudo'] . " !!!";

                   header('location:' . BASE);
                   exit;
                }
                else{

                    $_SESSION['messages']['danger'][] = "Erreur sur le mot de passe";
                }

            }
            else
            {
                $_SESSION['messages']['danger'][] = 'Aucun compte existant à cette adresse mail';
            }

        }

        include(VIEWS . 'security/login.php');
    }

    public static function logout()
    {
        //on supprime tout se qui est stocké dans la session avec l'indice 'user' (=déconnecter l'utilisateur)
        unset($_SESSION['user']);

        $_SESSION['messages']['info'][] = 'A bientôt !!!';

        header('location:' . BASE);
        exit;
    }

}