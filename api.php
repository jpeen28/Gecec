<?php
require "dbconnexion.php";

    if(isset($_POST['code_region'])) {
        $code_region = $_POST['code_region'];

        $stmt = $pdo->prepare("SELECT * FROM departements WHERE code_region=:code_region");
        $stmt->execute(['code_region' => $code_region]);
        $departements = $stmt->fetchAll();
        echo"<option value disabled selected >Selectionner un departement</option>";

        foreach($departements as $departement) {
            echo "<option value='". $departement["code_dept"] ."'>". $departement["FR"] ."</option>";
        }
    }

   
        if(isset($_POST['code_dept']) && ($_POST['region'])) {
            $code_dept = $_POST['code_dept'];
            $code_region = $_POST['region'];
            
            $stmt = $pdo->prepare("SELECT * FROM ctd WHERE code_region=:region and code_dept=:code_dept");
            $stmt->execute(['region' => $code_region , 'code_dept' => $code_dept ]);
            $ctds = $stmt->fetchAll();

            echo"<option value disabled selected>Arrondissement</option>";
            foreach($ctds as $ctd) {
                echo "<option value='". $ctd["code_cec"] ."'>". $ctd["FR"] ."</option>";
            }

         }
    
    if(isset($_POST['code_ctd']) && ($_POST['region'])) {
        $code_dept = $_POST['code_ctd'];
        $code_region = $_POST['region'];
        $stmt = $pdo->prepare("SELECT * FROM cec WHERE code_region=:region AND code_cec=:code_cec");
        $stmt->execute(['region' => $code_region ,'code_cec' => $code_dept ]);
        $cecs = $stmt->fetchAll();

        echo"<option value disabled selected>Centre d'Etat Civil</option>";
        foreach($cecs as $cec) {
            echo "<option value='". $cec["code"] ."'>". $cec["Localite"] ."</option>";
        }

    }



    if(isset($_POST['code_cec'])) {
        $codecec = $_POST['code_cec'];
        $stmt = $pdo->query("SELECT COUNT(*) FROM cec where code_cec=:code_cec");
        $cecs = $stmt->fetchAll();
        $nouveau=$cecs++;

        echo"value disabled selected>Centre d'Etat Civil";
        
    }









    if(isset($_POST['IdType_cec'])) {
        $typeCec = $_POST['IdType_cec'];

        $stmt = $pdo->prepare("SELECT * FROM actes_etat_civil WHERE IdType_cec=:IdType_cec");
        $stmt->execute(['IdType_cec' => $typeCec]);
        $types = $stmt->fetchAll();
        echo"<option>Selectionner un Type</option>";

        foreach($types as $type) {
            echo "<option value='". $type["typeCec"] ."'>". $type["libelle"] ."</option>";
        }
    }






?>

    
