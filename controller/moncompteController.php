<?php
class ajoutLivreController{

    public function __construct()
	{      
        //TODO
        session_start();
        //error_reporting(0);
        require_once "controller/Controller.php";
        require_once "vue/vueMonCompte.php";


        if (Controller::auth()) {
            $v = new vueMonCompte();
            $v->affiche();
        } else {

            header('Location: index.php?error=login');
        }
    }

}