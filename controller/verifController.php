<?php

//controller qui vérifie l'authentification.
//l'appel est fait par jquery .

class verifController
{

    public function __construct()
    {      
        session_start();
        error_reporting(0);
        //recuperation login et pwd du formulaire
        $login=$_POST['log'];
        $pwd=$_POST['pwd'];
        include_once "pdo/connectionPDO.php";
        include_once "Constantes.php";
        include_once "metier/Personne.php";
        include_once "pdo/PersonneDB.php";
        //connexion a la bdd
        $accesPersBDD=new PersonneDB($pdo);
        $result=$accesPersBDD->authentification($login, $pwd);
        if(empty($result)) {
            echo "erreur de login ou de mot de passe!!";
        }

        else {
            //conversion du pdo en objet
            $obj=(object)$result;
            $nom=$obj->login;
            $idpers=$obj->id;
            //creation d'un token et stockage en dans la variable de session
            $token = uniqid(rand(), true);
            $_SESSION['token'] = $token;
            //heure de creation du token en timestamp
            $_SESSION['token_time'] = time();
            $_SESSION['nom'] = $nom;
            $_SESSION['id'] = $idpers;
            //ok renvoyé au javascript pour rediriger vers accueil.php
            echo "ok-$token";
        }
    
    }
}