<?php
require 'dbconnexion.php';
require "session.php";

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM nouveaucec where id=:id");
$stmt->execute([':id' => $id ]);
$cec = $stmt->fetchObject();
if (isset ($_POST['regnaissance'])  && isset($_POST['regmariage']) && isset($_POST['regdeces']) && isset($_POST['regparaphe']) && isset($_POST['regcloture']) && isset($_POST['naissance']) && isset($_POST['mariage']) && isset($_POST['deces']) && isset($_POST['etat']) && isset($_POST['observation']) ) {
  $regnaissance = $_POST['regnaissance'];
  $regmariage = $_POST['regmariage'];
  $regdeces = $_POST['regdeces'];
  $regparaphe = $_POST['regparaphe'];
  $regcloture = $_POST['regcloture'];
  $naissance = $_POST['naissance'];
  $mariage = $_POST['mariage'];
  $deces = $_POST['deces'];
  $etat = $_POST['etat'];
  $observation = $_POST['observation'];
  $sql = 'UPDATE statistque SET regnaissance=:nbrregnais, regmariage=:nbrregmariage, regdeces=:nbregdec, regparaphe=:nbrregpara, regcloture=:nbrregclot, naissance=:nbractnai, mariage=:nbractmar,deces=:nbractdec,etat=:fonctionnel, obsersation=:commentaire, role=:role WHERE Id=:id';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':nbrregnais' => $regnaissance, ':nbrregmar' => $regmariage, ':nbrregdec' => $regdeces, ':nbrregpar' => $regparaphe, ':nbrregclot' => $regcloture, ':nbractnai' => $naissance, ':nbractmar' => $mariage, ':nbractdec' => $deces,':fonctionnel' => $etat,':commentaire' => $observation, ':Id' => $id])) {
    header("Location:hcollecte.php");
  }
}
 ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <title>GECEC MINDDEVEL | Nouveau CEC</title>
</head>

<body class="img js-fullheight" style="background-image: url(img/img1.jpg);">
<div class="sidebar">
        <div class="logo_content">
            <div class="logo">
                <div class="logo_name">GECEC MINDDEVEL</div>
            </div>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav_list">
            <li>
                <a href="dashboard.php">
                    <i class='bx bxs-grid-alt'></i>
                    <span class="links_name">Tableau de Bord</span>
                </a>
                <!-- Tooltip -->

                <span class="tooltip">Dashboard</span>
            </li>
            <?php if($_SESSION['user']['role']=="collecteur"){?>
            <li>
                <a href="collecte.php">
                    <i class='bx bxs-pen'></i>
                    <span class="links_name">Collecte</span>
                </a>
                <!-- Tooltip -->

                <span class="tooltip">Collecte</span>
            </li>
           <?php } ?>
            <li>
                <a href="nouveau.php">
                    <i class='bx bx-plus'></i>
                    <span class="links_name">Nouveau</span>
                </a>
                <!-- Tooltip -->

                <span class="tooltip">Nouveau</span>
            </li>
            <li>
                <a href="cartectd.php">
                    <i class='bx bx-map'></i>
                    <span class="links_name">Carte CTD</span>
                </a>
                <!-- Tooltip -->

                <span class="tooltip">Carte CTD</span>
            </li>
            <li>
                <a href="hcollecte.php">
                    <i class='bx bx-edit'></i>
                    <span class="links_name">Edition</span>
                </a>
                <!-- Tooltip -->

                <span class="tooltip">Edition</span>
            </li>
            <li>
                <a href="utilisateur.php">
                    <i class='bx bxs-user'></i>
                    <span class="links_name">Utilisateurs</span>
                </a>
                <!-- Tooltip -->

                <span class="tooltip">Utilisateurs</span>
            </li>
            <li>
                <a href="parametres.php">
                    <i class='bx bxs-cog'></i>
                    <span class="links_name">Parametres</span>
                </a>
                <!-- Tooltip -->

                <span class="tooltip">Parametres</span>
            </li>
        </ul>

        <div class="profile-content">
            <div class="profile">
                <div class="profile-details">
                    <img src="img/cmr.png" alt="">
                    <div class="name-job">
                        <div class="name">GECEC</div>
                        <div class="job">MINDDEVEL</div>
                    </div>
                </div>
                <a href="deconnexion.php"><i class='bx bx-log-out' id="log-out"></i></a>
            </div>
        </div>
    </div>
    <div class="home-content">
        
        
        <div class="nouveaucec">
            <div class="form-new-cec">
                <h2 class="title">Mise à Jour des informations du centre
                    <h5 class="description">Verifier que tous les champs soient remplis avant de soumettre le formulaire</h5>
                </h2>
                <form action="enregistrement.php" method="post" class="new-cec-form">
                    <input type="string" id="code"  name="code" placeholder="Code du centre" readonly class="input" value="<?= $cec->codecec?>">

                    <select  name="region" id="region" onchange="getDepartement(this.value)" required class="select" onchange="getCode()">
                        <option value disabled selected>Selectionner une region</option>
                        <?php foreach ($regions as $region) { ?>
                        <option value="<?= $region['code_region'] ?>"><?= $region['FR'] ?></option>
                        <?php } ?>
                    </select>

                    <select class="select" id="departement" name="departement" onchange="getCtd(this.value)" required onchange="getCode()">
                        <option value disabled selected >Selectionner un departement</option>
                    </select>

                   <select class="select" name="arrondissement" id="ctd" onchange="getCec(this.value)" required onchange="getCode()">
                        <option value disabled selected>Selectionner un Arrondissement</option>
                    </select>
                    
                    <input type="text" value="<?= $cec->localite?>" name="localite" id="localite" placeholder="Localite" class="input" required>
                    <input type="text" value="<?= $cec->nomcec?>" name="nomcec" id="nomcec" placeholder="Nom du centre d'etat civil" class="input" required>
                    <select name="nature" id="nature"class="select" required>
                        <option value="<?= $cec->naturecec?>" disabled selected><?=print_r($cec->naturecec)?></option>
                        <option value="Principal">Principal</option>
                        <option value="Secondaire">Secondaire</option>
                    </select>
                    <input type="text" value="<?= $cec->rattachement?>" name="rattachement" id="rattachement" placeholder="Centre de rattachement" class="input" required>
                    <input type="file" name="upload" id="upload" class="input">
                    <div class="bnt-ctrl">
                        <input type="reset" value="Annuler" id="danger">
                        <input type="submit" value="Sauvegarder" id="ok">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>



<script>
    function getDepartement(region) {
        $.ajax({
            type: "POST",
            url: "api.php",
            data: {
                code_region: region
            },
            success: function (response) {
                document.getElementById("departement").innerHTML = response;
            }
        });
    }

    function getCtd(departement) {
        var region = document.getElementById("region").value;
        $.ajax({
            type: "POST",
            url: "api.php",
            data: {
                region: region,
                code_dept: departement
            },
            success: function (response) {

                document.getElementById("ctd").innerHTML = response;
            }
        });
    }

    function getCode(){
        var reg =document.getElementById("region").value;
        var dept = document.getElementById("departement").value;
        var arr = document.getElementById("ctd").value;
        var total = reg + dept + arr;
        console.log(total);
        document.getElementById("code").value = total;
    }
</script>





    

    <script>
        let btn = document.querySelector("#btn");
        let sidebar = document.querySelector(".sidebar");
        let searchbtn = document.querySelector(".bx-search");

        btn.onclick = function() {
            sidebar.classList.toggle("active");
        }

        searchbtn.onclick = function() {
            sidebar.classList.toggle('active');
        }
    </script>
</body>

</html>