<?php
session_start();
require_once('dbconnexion.php');
$username=isset($_POST['username'])?$_POST['username']:"";
$password=isset($_POST['password'])?$_POST['password']:"";
$requete="select * from user where identifiant='$username'and password='$password'" ;
$resultat=$pdo->query($requete);
if ($user=$resultat->fetch()){
    if($user['etat']==1){
        $_SESSION['user']=$user;
        header('location:dashboard.php');
    }
    else{
        $_SESSION['errlogin']="<strong>Erreur</strong>Votre Compte est desactivé";
        header('location:index.php');
    }
}
else{
    $_SESSION['errlogin']="<strong>Erreur</strong>Login ou mot de passe incorrect";
    header('location:index.php');
}
?>