<?php
class validMonCompteController
{

    public function __construct()
    {  //TODO    
        session_start();
        $login = $_POST['login'];
        $pwd = $_POST['pwd'];
        require_once "pdo/connectionPDO.php";
        require_once "Constantes.php";
        require_once "metier/Personne.php";
        require_once "pdo/PersonneDB.php";
        //connexion a la bdd
        $accesPersBDD = new PersonneDB($pdo);
        $result = $accesPersBDD->authentification($login, $pwd);
        if (empty($result)) {
            echo "erreur de login ou de mot de passe!!";
        } else {
            //conversion du pdo en objet
            $pers = new Personne(
                $_POST['nom'],
                $_POST['prenom'],
                DateTime::createFromFormat('Y-m-d', $_POST['datenaissance']),
                $_POST['telephone'],
                $_POST['email'],
                $_POST['login'],
                md5($_POST['pwd']),
                new Adresse(1, 5 , "ytgfh", 35000, "YUF", 1)
            );
            $pers->setId($result['id']);
            $pers->setPwd(($_POST['newpwd']) ?: $_POST['pwd']);
            $accesPersBDD->update($pers);
            $token = uniqid(rand(), true);
            $_SESSION['token'] = $token;
            $_SESSION['token_time'] = time();
            $_SESSION['nom'] = $result['nom'];
            $_SESSION['id'] = $result['id'];
            echo "ok-$token";
        }
    }
}
