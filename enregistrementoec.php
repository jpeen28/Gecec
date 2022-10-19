
<?php
    require "dbconnexion.php";
    $region = $_POST["region"];
    $departement = $_POST["departement"];
    $arrondissement = $_POST["arrondissement"];
    $localite = $_POST["localite"];
    $nomoec = $_POST["nomoec"];
    $ref = $_POST["ref"];
    $upload = $_POST["upload"];
    $poste = $_POST["poste"];
   
    try{
        //On se connecte à la BDD
        $dbco = new PDO("mysql:host=$serveur;dbname=$dbname",$user,$pass);
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sth = $dbco->prepare("
            INSERT INTO nouveauoec(region, departement, arrondissement, localite, nomoec, reference, arrete, poste)
            VALUES( :region, :departement, :arrondissement, :localite, :nomoec, :ref, :upload, :poste)");

        $sth->bindParam(':region',$region);
        $sth->bindParam(':departement',$departement);
        $sth->bindParam(':arrondissement',$arrondissement);
        $sth->bindParam(':localite',$localite);
        $sth->bindParam(':nomoec',$nomoec);
        $sth->bindParam(':ref',$ref);
        $sth->bindParam(':upload',$upload);
        $sth->bindParam(':poste',$poste);
        $sth->execute();
        header("Location:nouveauoec.php");
    }
    catch(PDOException $e){
        echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
    }
?>


