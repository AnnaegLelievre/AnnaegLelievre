<?php
class ajoutLivreController
{

    public function __construct()
    {      
        session_start();
        error_reporting(0);
        include_once "controller/Controller.php";
        include_once "vue/vueAjoutLivre.php";


        if(Controller::auth()) {
            $v=new vueAjoutLivre();
            $v->affiche();

        }
    

        else
        {
    
            header('Location: index.php?error=login');

        }

    }
}
        
