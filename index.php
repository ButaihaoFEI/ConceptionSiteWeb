<?php
require_once("param.inc.php");
require_once("Database.php");

//var_dump($_SESSION);

$db = new Database($db_config);

session_start();
if (isset($_GET['logout'])) {
    unset($_SESSION['identifiant']);
    unset($_SESSION['droits']);
    header('Location: index.php');
    die();
}


//unset($_SESSION['msg']);

if (isset($_POST) && isset($_POST['inputEmail']) && isset($_POST['inputPassword']) && isset($_POST['register']) && $_POST['register'] == 'register') {
    $post = [];
    foreach ($_POST as $item => $value) {
        $post[$item] = htmlentities($value);
    }

    $db->insert('utilisateur', [
        'email' => $post['inputEmail'],
        'motdepasse' => password_hash($post['inputPassword'], PASSWORD_DEFAULT),
        'droits' => 0
    ]);


} else if (isset($_POST) && isset($_POST['inputEmail']) && isset($_POST['inputPassword']) && isset($_POST['connect']) && $_POST['connect'] == 'connect') {
    $post = [];
    foreach ($_POST as $item => $value) {
        $post[$item] = htmlentities($value);
    }

    $user = $db->get('utilisateur', [
        'email' => $post['inputEmail']
    ]);

    $password_verify = password_verify($post['inputPassword'], $user['motdepasse']);
    if ($password_verify) {
        $_SESSION['identifiant'] = $user['identifiant'];
        $_SESSION['droits'] = $user['droits'];
    } else {
        $_SESSION['msg'] = 'Mauvais identifiant et/ou mauvais mot de passe';
    }
} else if (isset($_POST) && isset($_POST["nom"]) && isset($_POST["couleur"])) {
    $nom = htmlentities($_POST["nom"]);
    $couleur = htmlentities($_POST["couleur"]);

    $db->insert('objet', [
        'nom' => $nom,
        'couleur' => $couleur,
        'etat' => $_SESSION['droits'],
        'date_ajout' => date("Y-m-d H:i:s")
    ]);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Les objets perdus</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!--    <link rel="stylesheet" href="https://code.getmdl.io/1.2.1/material.blue-red.min.css">-->
    <link rel="stylesheet" href="css/material.blue-red.min.css">
    <link rel="stylesheet" href="css/list.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/stats.css">

</head>
<body>
<?php if (isset($_SESSION['msg'])): ?>
    <span class="msg-box" onclick="this.style.display = 'none'">
    <?= $_SESSION['msg'] ?>
</span>
    <?php
    unset($_SESSION['msg']);
endif;
?>

<header>
    <a href="index.php"><img src="images/logo_esigelec.png" alt="logo" width="400"></a>
    <span id="navigation">
        <?php if ($_SESSION['droits'] == 2): ?>
            <a href="index.php?statistiques">Statistiques</a>
        <?php endif; ?>
        <?php if (isset($_SESSION['identifiant'])): ?>
            <a href="index.php?logout">Déconnexion</a>
        <?php endif; ?>
    </span>
</header>
<!--<script defer src="https://code.getmdl.io/1.2.1/material.min.js"></script>-->
<script defer src="js/material.min.js"></script>

<?php
if (!isset($_SESSION['identifiant'])) {
    include "login.inc.php";
    // var_dump("login.inc.php");
} else {
    if (isset($_GET['ajouter']) && $_SESSION['droits'] != 2) {
        include "ajouter.inc.php";
        // var_dump("ajouter.inc.php");
    } elseif (isset($_GET['statistiques']) && $_SESSION['droits'] == 2) {
        include "stats.inc.php";
        // var_dump("stats.inc.php");
    } else {
        include "list.inc.php";
        // var_dump("list.inc.php");
    }
}
?>
<div style="height: 100px;"></div>
<footer>
    &copy; ESIGELEC 2016
</footer>
<script type="text/javascript">
    /*    hide = function (elem) {
     console.log(elem);
     elem.style.display = 'none';
     }*/
</script>
</body>
</html>