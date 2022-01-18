<?php
require_once "PDO/PersonneDB.php";
require_once "vue/Vue.php";
class vueMonCompte extends Vue
{
	function affiche()
	{
		//parametre de connexion à la bae de donnée
		$strConnection = Constantes::TYPE . ':host=' . Constantes::HOST . ';dbname=' . Constantes::BASE;
		$arrExtraParam = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
		$db = new PDO($strConnection, Constantes::USER, Constantes::PASSWORD, $arrExtraParam); //Ligne 3; Instancie la connexion
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		include "header.html";
		include "menu.php";
		$truc = new PersonneDB($db);
		$moi = $truc->selectionId($_SESSION['id']);

?>

		<form method="post" action="index.php?action=validCompte&amp;id=<?php echo $_SESSION['token']; ?>required">
			<div class="form-group">
				<div class="form-row">
					<label>Login</label>
					<input class="form-control" type="text" name="login" value="<?php echo $moi->getLogin(); ?>">
				</div>
				<div class="form-row">
					<label>Nom</label>
					<input class="form-control" type="text" name="nom" value="<?php echo $moi->getNom(); ?>">
				</div>
				<div class="form-row">
					<label>Prenom</label>
					<input class="form-control" type="text" name="prenom" value="<?php echo $moi->getPrenom(); ?>">
				</div>
				<div class="form-row">
					<label>Date de naissance</label>
					<input class="form-control" type="date" name="datenaissance" value="<?php echo $moi->getDatenaissance()->format('Y-m-d'); ?>">
				</div>
				<div class="form-row">
					<label>Téléphone</label>
					<input class="form-control" type="tel" name="telephone" value="<?php echo $moi->getTelephone(); ?>">
				</div>
				<div class="form-row">
					<label>Email</label>
					<input class="form-control" type="email" name="email" value="<?php echo $moi->getEmail(); ?>">
				</div>
				<button class="btn btn-primary" type="submit">Modifier</button>
			</div>
		</form>

<?php include "footer.html";
	}
}
