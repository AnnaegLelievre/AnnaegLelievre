<?php
require_once "vue/Vue.php";
class vueAjoutLivre extends Vue
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
<!--
		<link rel="stylesheet" type="text/css" href="https://releases.jquery.com/git/ui/jquery-ui-git.css">
		<script type="text/javascript" src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
		<script>
			jQuery(function() {
				jQuery("input[name=datenaissance]").datepicker();
			});
		</script>

		<script LANGUAGE="javascript">
			$(document).ready(function() {
				$('input[name*=newpwd]').on("input", function() {
					if ($('input[name=newpwd]').val() != $('input[name=newpwd2]').val()) {
						$('input[name*=newpwd]').addClass('is-invalid');
					} else {
						$('input[name*=newpwd]').removeClass('is-invalid');
					}
				});
				$(".verif_form").submit(function() {
					if (!$('input[name*=newpwd]').hasClass('is-invalid')) {
						$.post($(this).attr("action"), $(this).serialize(), function(data) {
							console.log(data);
							var ok = data.substr(0, 2);
							var token = data.substr(3, data.length);
							if (ok == "ok") {
								$(location).attr('href', "index.php?action=moncompte&id=" + token);
							} else
								$("#messagee").html(data).show();
						});
					}
					return false;
				});
			});
		</script>
		-->
<?php include "footer.html";
	}
}
