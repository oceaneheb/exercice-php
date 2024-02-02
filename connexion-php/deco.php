<?php 
//Activer la super global $_SESSION
session_start();

// echo $_SESSION['login_user'];

//Détruire les données de la super global -> Déconnexion
session_destroy();

//Redirection vers la page index.php
header('Location: ./index.php');
exit;

?>