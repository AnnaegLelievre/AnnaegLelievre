<?php
class accueilController
{

    public function __construct()
    {      
        session_start();
        error_reporting(0);
        include_once "controller/Controller.php";
        include_once "vue/vueAccueil.php";


        if(Controller::auth()) {
            $v=new vueAccueil();
            $v->affiche();

        }
    

        else
        {
    
            header('Location: index.php?error=login');

        }
    }
}