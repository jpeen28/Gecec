<?php
   require_once("dbconnexion.php");
    
    $codecec = $_POST["code"];
    $region = $_POST["region"];
    $departement = $_POST["departement"];
    $arrondissement = $_POST["arrondissement"];
    $localite = $_POST["localite"];
    $nomcec = $_POST["nomcec"];
    $nature = $_POST["nature"];
    $rattachement = $_POST["rattachement"];
    $piece = $_POST["upload"];
  
   
    try{
        //On se connecte à la BDD
        $dbco = new PDO("mysql:host=$serveur;dbname=$dbname",$user,$pass);
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sth = $dbco->prepare("
            INSERT INTO nouveaucec(codecec, codereg, codedpt, codectd, localite, nomcec, naturecec, rattachement, pieces)
            VALUES( :code, :region, :departement, :arrondissement, :localite, :nomcec, :nature, :rattachement, :upload)");

        $sth->bindParam(':code',$codecec);
        $sth->bindParam(':region',$region);
        $sth->bindParam(':departement',$departement);
        $sth->bindParam(':arrondissement',$arrondissement);
        $sth->bindParam(':localite',$localite);
        $sth->bindParam(':nomcec',$nomcec);
        $sth->bindParam(':nature',$nature);
        $sth->bindParam(':rattachement',$rattachement);
        $sth->bindParam(':upload',$piece);
        $sth->execute();
        header("Location:nouveau.php");
    }
    catch(PDOException $e){
        echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
    }
?>