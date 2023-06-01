<?php

/**
 * Fichier contenant la configuration de l'application
 */
const CONFIG = [
    'db' => [
        'DB_HOST' => 'localhost',
        'DB_PORT' => '3306',
        'DB_NAME' => 'mvc',
        'DB_USER' => 'root',
        'DB_PSWD' => '',
    ],
    'app' => [
        'name' => 'Mon Projet',
        'projectBaseUrl' => 'http://localhost/PROJET_MVC'
    ]
];

/**
 * Constantes pour accéder rapidement aux dossiers importants du MVC
 */
const BASE_DIR = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR  ;
// constantes à appeler dans l'html
const BASE= CONFIG['app']['projectBaseUrl'] . '/public/index.php/';
const UPLOAD = CONFIG['app']['projectBaseUrl'] . '/public/upload/';
// constantes à appeler dans le php
const PUBLIC_FOLDER = BASE_DIR . 'public' . DIRECTORY_SEPARATOR;
const VIEWS = BASE_DIR . 'views/';
const MODELS = BASE_DIR . 'src/models/';
const CONTROLLERS = BASE_DIR . 'src/controllers/';


/**
 * Liste des actions/méthodes possibles (les routes du routeur)
 */
$routes = [
    ''                  => ['AppController', 'index'],
    '/'                 => ['AppController', 'index'],
    '/produit/ajout'    => ['AdminController', 'ajoutProduit'],
    '/produit/gestion'  => ['AdminController', 'gestionProduit'],
    '/produit/modifier' => ['AdminController', 'modifierProduit'],
    '/produit/supprimer' => ['AdminController', 'supprimerProduit'],
    '/produit/vue' => ['AppController', 'vueProduit'],
    '/inscription' => ['SecurityController', 'inscription'],
    '/login'  => ['SecurityController', 'login'],
    '/logout' => ['SecurityController', 'logout'],
    '/user/gestion' => ['AdminController', 'gestionUser'],
    '/user/supprimer' => ['AdminController', 'supprimerUser'],
    '/user/role'    => ['AdminController', 'modifierRole'],
    '/cart/add'   => ['AppController', 'addCart'],
    '/cart/view'  => ['AppController', 'viewCart'],
    '/cart/substract' => ['AppController', 'substractCart'],
    '/cart/remove' => ['AppController', 'removeCart'],
    '/cart/delete' => ['AppController', 'deleteCart'],
    '/profil/view' => ['AppController', 'viewProfil'],
    '/profil/pseudo' => ['AppController', 'modifierPseudo'],
    '/profil/password' => ['AppController', 'modifierPassword'],
    '/profil/delete' => ['AppController', 'deleteAccount'],
    '/commande/finaliser'=>['AppController', 'finaliserCommande'],
   '/commande/formulaire' =>['AppController', 'ajoutAdresse'],
   '/commande/pay'=>['AppController', 'createOrder'],
   '/comment/add' => ['ReviewController', 'ajoutCommentaire'],
   '/produit/category'             => ['AdminController', 'addCategory'],
    '/produit/gestioncategory'             => ['AdminController', 'gestionCategory'],
    '/produit/deletecategory'             => ['AdminController', 'deleteCategory'],
    '/produit/modifiercategory'             => ['AdminController', 'modifierCategory'],

    



];
