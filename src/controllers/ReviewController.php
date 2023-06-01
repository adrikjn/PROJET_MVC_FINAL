<?php

class ReviewController
{
public static function ajoutCommentaire()
{
    //vérifie que le formulaire est submit
    if(!empty($_POST))
    {
        //on initialise notre tableau d'erreur
        $error = [];

        if(empty($_POST['comment']))
        {
            $error['comment'] = 'Mettez un commentaire';
        }
        if(empty($_POST['rating']))
        {
            $error['rating'] = 'Mettez une note!';
        }
       
        function afficherDate()
        {
            $timezone = 'Europe/Paris'; // Définir le fuseau horaire souhaité
            $date = new DateTime('now', new DateTimeZone($timezone));
            return $date->format('Y-m-d H:i:s');
        }
        //si notre tableau d'erreur est rester vide (donc si on a aucune erreur)
        if(!$error)
        {

            $date = afficherDate();
            //on envoie les infos en BDD
            Review::ajouterCommentaire([
               'id_user' => $_SESSION['user']['id_user'],
               'id_product' => $_GET['id'],
               'comment' => $_POST['comment'],
               'created_at' => date_format(new DateTime(), 'Y-m-d H:i:s'),
               'rating' => $_POST['rating'],
            ]);
            $_SESSION['messages']['success'][] = "Votre commentaire a bien été envoyé";
            header("location:" . BASE . 'produit/vue?id=' . $_GET['id']);
            exit;
        }
        
    }
    include(VIEWS . 'app/vueProduit.php');
}
}
