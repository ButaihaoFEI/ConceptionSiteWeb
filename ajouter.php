<?php

if ($_SERVER["REQUEST_METHOD"]=="POST"){
session_start();
$nom = $_POST["nom"];
$couleur = $_POST["couleur"];

if ($_SESSION['droits']==0)
	$etat=0;
if ($_SESSION['droits']==1)
	$etat=1;


require_once("param.inc.php");
$mysqli = new mysqli($db_config['host'], $db_config['login'], $db_config['password'], $db_config['dbname']);
if ($mysqli->connect_errno) {
echo "Echec lors de la connexion à MySQL : (" . $mysqli-> connect_errno . ") " . $mysqli->connect_error;
}else{
	$res=$mysqli -> query("INSERT INTO objet (nom, couleur,etat) VALUES ('$nom', '$couleur','$etat');");
    if ($_SESSION['droits']==0)
	$_SESSION['msg'] = 'Vous avez joint un objet perdu !';
    if ($_SESSION['droits']==1)
    $_SESSION['msg'] = 'Vous avez joint un objet trouvé!';
}}
?>
	 
	 
	 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Les objets perdus</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.2.1/material.blue-red.min.css">
    <link rel="stylesheet" href="css/formstyle.css">
	
</head>
<body>
	<?php if (isset($_SESSION['msg'])): ?>
<span class="msg-box">
    <?= $_SESSION['msg'] ?>
</span>
<?php endif; ?>

<header style="background-color:black;">
    <img src="images/logo_esigelec.png" alt="logo" width="400">
    <span id="navigation" style="right: 0; text-align: right; background-color:#ffff00;">
        <a href="index.php?logout">Déconnexion</a>
    </span>
</header>
<script defer src="https://code.getmdl.io/1.2.1/material.min.js"></script>

<div class="div">
<br>
<?php if ($_SESSION['droits']==0)?>
<p id="title"> Ajouter un objet </p>

<?php if ($_SESSION['droits']==1)?>
<p id="title"> Retrouver un objet </p>


	<!-- Textfield with Floating Label -->

<form action="#" method="post">
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" >
    <input class="mdl-textfield__input" name="nom" type="text" id="sample3">
    <label class="mdl-textfield__label" for="sample3">Nom...</label>
  </div>
<br>
<!-- Textfield with Floating Label -->

  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" >
    <input class="mdl-textfield__input" name="couleur" type="text"  id="sample4">
    <label class="mdl-textfield__label" for="sample4">Couleur...</label>
  </div>
<br>

<!-- Raised button -->
<button class="mdl-button mdl-js-button mdl-button--raised" input type="post">
  Valider
</button>
<button class="mdl-button mdl-js-button mdl-button--raised" input type="reset">
  Annuler
</button>
</div>
</form>

<footer>
    bas de page & infos supplementaire
</footer>
</body>
</html>