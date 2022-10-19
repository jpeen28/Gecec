<?php
require_once("dbconnexion.php");
require "session.php";

if($user = $_SESSION['user']['code_region']){
    $stmt = $pdo->query("SELECT * FROM region where code_region ='$user'");
    $regions = $stmt->fetchAll();
}
if($dept = $_SESSION['user']['identifiant']){
    $stmt = $pdo->query("SELECT * FROM departements where FR ='$dept' ");
    $depart = $stmt->fetchAll();
} 

if($arr = $_SESSION['user']['code_cec']){
    $stmt = $pdo->query("SELECT * FROM ctd where id ='$arr' ");
    $arron = $stmt->fetchAll();
   
} 
if($cec = $_SESSION['user']['code']){
    $stmt = $pdo->query("SELECT * FROM cec where code ='$cec' ");
    $loc = $stmt->fetchAll();
} 


if (isset($_POST["submit"])) {
    extract($_POST);
   
    
    if(isset($fonctionnelle)){
        $sql = $pdo->prepare("INSERT INTO statistique(code, nbrregnais, nbrregmar, nbrregdec, nbrregpara, nbrregclot, nbractmar, nbractnai, nbractdec, commentaire, fonctionnel, datecreation)
        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)");
  
      $sql->execute([$code_cec, $regnaissance, $regmariage, $regdeces, $regparaphe, $regcloture, $naissance, $mariage, $deces, $observation, $fonctionnelle, date("Y-m-d")]);
  
    }else if ($nonfonctionnelle){
        $sql = $pdo->prepare("INSERT INTO statistique(code, nbrregnais, nbrregmar, nbrregdec, nbrregpara, nbrregclot, nbractmar, nbractnai, nbractdec, commentaire, fonctionnel, datecreation)
        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)");
  
      $sql->execute([$code_cec, $regnaissance, $regmariage, $regdeces, $regparaphe, $regcloture, $naissance, $mariage, $deces, $observation, $nonfonctionnelle, date("Y-m-d")]);

    }
    header('Location:collecte.php');

}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/main-main.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <title>GECEC MINDDEVEL | Collecte</title>
</head>

<body class="img js-fullheight" style="background-image: url(img/img1.jpg);">
<div class="sidebar" id="sidebar">
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
            <?php }?>

            <?php if($_SESSION['user']['role']=="administrateur"){?>
            <li>
                <a href="nouveau.php">
                    <i class='bx bx-plus'></i>
                    <span class="links_name">Nouveau</span>
                </a>
                <!-- Tooltip -->

                <span class="tooltip">Nouveau</span>
            </li>
            <?php }?>
            <li>
                <a href="cartectd.php">
                    <i class='bx bx-map'></i>
                    <span class="links_name">Carte CTD</span>
                </a>
                <!-- Tooltip -->

                <span class="tooltip">Carte CTD</span>
            </li>
            <?php if($_SESSION['user']['role']=="administrateur"){?>
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
            <?php }?>
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
                        <div class="job"><h3 class="bandeau-user"><?php echo $user =$_SESSION['user']['identifiant']; ?></h3></div>
                    </div>
                </div>
                <a href="deconnexion.php"><i class='bx bx-log-out' id="log-out"></i></a>
            </div>
        </div>
    </div>
    <div class="home-content">
    <div class="page-content">
        <div class="wizard-v4-content">
            <div class="wizard-form">
                <div class="wizard-header">
                    <h3 class="heading">Collecte des informations des CTD</h3>
                    <p>Remplir tous les champs vides avant de passer au suivant</p>
                </div>
                <form class="form-register" action="" method="post">
                    <div id="form-total">
                        <!-- SECTION 1 -->
                        <h2>
                            <span class="step-icon"><i class="zmdi">1</i></span>
                            <span class="step-text">étape</span>
                        </h2>
                        <section>
                            <div class="inner">
                                <h3>Informations Generales sur le Centre d'etat civil</h3>
                                <div id="Nature">
                                    <div class="Nature-Etat-civil">
                                        <label class="Nature-Centre">Nature du Centre :</label>
                                        <input type="radio" id="Principal" name="Nature" value="Principal" disabled>
                                        <label for="Principal">Principal</label>
                                        <input type="radio" id="Secondaire" name="Nature" value="Secondaire" disabled>
                                        <label for="Secondaire">Secondaire</label>
                                    </div>
                                    <div>
                                    <input type="text" placeholder="Code du Centre d'etat Civil" id="code_cec"class="Nature-Name" value="<?= $local->code ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-holder form-holder-2">
                                        <select name="region" id="region" onchange="getDepartement(this.value)" required>
                                            <?php foreach ($regions as $region) { ?>
                                                <option value="<?= $region['code_region'] ?>"><?= $region['FR'] ?></option>
                                            <?php } 
                                            ?>
                                           <?php foreach ($depart as $departe) { ?>
                                                <option value="<?= $departe['code_region'] ?>"><?= $departe['code_region'] ?></option>
                                            <?php } ?>
                                            <?php foreach ($arron as $arrond) { ?>
                                                <option value="<?= $arrond['code_region'] ?>"><?= $arrond['FR'] ?></option>
                                            <?php } ?>
                                            <?php foreach ($loc as $local) { ?>
                                                <option value="<?= $local['code_region'] ?>"><?= $local['code_region'] ?></option>
                                            <?php } ?>
                                         
										</select>
                                    </div>

                                    <div class="form-holder form-holder-2">
                                        <select name="Departement" id="departement" onchange="getCtd(this.value)" required>
                                            <?php foreach ($depart as $departe) { ?>
                                                <option value="<?= $departe['code_dept'] ?>"><?= $departe['FR'] ?></option>
                                            <?php } ?>
                                            <?php foreach ($arron as $arrond) { ?>
                                                <option value="<?= $arrond['code_dept'] ?>"><?= $arrond['FR'] ?></option>
                                            <?php } ?>

                                            <?php foreach ($loc as $local) { ?>
                                                <option value="<?= $local['code_dept'] ?>"><?= $local['Libellé'] ?></option>
                                            <?php } ?>
                                           
										</select>
                                    </div>

                                </div>

                                <div class="form-row">
                                    <div class="form-holder form-holder-2">
                                        <select name="ctd" id="ctd" onchange="getCec(this.value)" required>
											
                                            <?php foreach ($arron as $arrond) { ?>
                                                <option value="<?= $arrond['code_cec'] ?>"><?= $arrond['FR'] ?></option>
                                            <?php } ?>

                                            <?php foreach ($loc as $local) { ?>
                                                <option value="<?= $local['code_cec'] ?>"><?= $local['FR'] ?></option>
                                            <?php } ?>
										</select>
                                    </div>
                                    <div class="form-holder form-holder-2">
                                        <select name="cec" id="cec" onchange="setCodeCec(this)" required>
											
                                            <?php foreach ($loc as $local) { ?>
                                                <option value="<?= $local['code'] ?>"><?= $local['Localite'] ?></option>
                                            <?php } ?>
										</select>
                                    </div>

                                </div>
                            </div>
                        </section>
                        <!-- SECTION 2 -->
                        <h2>
                            <span class="step-icon"><i class="zmdi">2</i></span>
                            <span class="step-text">étape</span>
                        </h2>
                        <section>
                            <div class="inner">
                                <h3>SITUATION DES REGISTRES</h3>
                                <div class="form-row">
                                    <div class="form-holder">
                                        <label class="form-row-inner">
											<input type="text" name="regnaissance" id="regnaissance" onchange="getTotal()" class="form-control" required>
											<span class="label">Nombre Registre Naissance</span>
											<span class="border"></span>
										</label>
                                    </div>
                                    <div class="form-holder">
                                        <label class="form-row-inner">
											<input type="text" name="regmariage" id="regmariage" onchange="getTotal()" class="form-control" required>
											<span class="label">Nombre Registre Mariage</span>
											<span class="border"></span>
										</label>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-holder">
                                        <label class="form-row-inner">
											<input type="text" name="regdeces" id="regdeces" onchange="getTotal()" class="form-control" required>
											<span class="label">Nombre de Registre Deces</span>
											<span class="border"></span>
										</label>
                                    </div>
                                    <div class="form-holder">
                                        <label class="form-row-inner">
											<input type="text" name="regtotal" id="regtotal" disabled="disabled" class="form-control"required placeholder="Total de registre">
											<span class="border"></span>
										</label>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-holder">
                                        <label class="form-row-inner">
											<input type="text" name="regparaphe" class="form-control" required>
											<span class="label">Nombre Registre Paraphé</span>
											<span class="border"></span>
										</label>
                                    </div>
                                    <div class="form-holder">
                                        <label class="form-row-inner">
											<input type="text" name="rgcloture"  class="form-control" required>
											<span class="label">Nombre Registre Cloturé</span>
											<span class="border"></span>
										</label>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- SECTION 3 -->
                        <h2>
                            <span class="step-icon"><i class="zmdi">3</i></span>
                            <span class="step-text">étape</span>
                        </h2>
                        <section>
                            <div class="inner">
                                <h3>STATISTIQUES DES ACTES D’ETAT CIVIL ETABLIS</h3>
                                <div class="form-row">
                                    <div class="form-holder">
                                        <label class="form-row-inner">
											<input type="text" class="form-control" id="first-name-1" name="naissance" required>
											<span class="label">Nombre Acte Naissance</span>
											<span class="border"></span>
										</label>
                                    </div>
                                    <div class="form-holder">
                                        <label class="form-row-inner">
											<input type="text" class="form-control" id="last-name-1" name="mariage" required>
											<span class="label">Nombre Acte Mariage</span>
											<span class="border"></span>
										</label>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-holder">
                                        <label class="form-row-inner">
											<input type="text" class="form-control" id="first-name-1" name="deces" required>
											<span class="label">Nombre Acte Deces</span>
											<span class="border"></span>
										</label>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- SECTION 4 -->
                        <h2>
                            <span class="step-icon"><i class="zmdi">4</i></span>
                            <span class="step-text">étape</span>
                        </h2>
                        <section>
                            <div class="inner">
                                <h3>OBSERVATIONS EVENTUELLES</h3>
                                

                                <div class="form-row">

                                <div class="form-holder form-holder-2">
                                    <select name="etat">
										<option value disabled selected>Etat du centre d'etat civil</option>
                                        <option value="Fonctionnel">Fonctionnel</option>
                                        <option value="Non Fonctionnel">Non Fonctionnel</option>
									</select>
                                </div>



                                    <div class="form-holder form-holder-2">
                                        <label class="form-row-inner">
											<input type="text" name="balance" id="balance" class="form-control" required>
											<span class="label">Observations</span>
											<span class="border"></span>
										</label>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </form>
            </div>
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

    function getCec(ctd) {
        var region = document.getElementById("region").value;
        $.ajax({
            type: "POST",
            url: "api.php",
            data: {
                region: region,
                code_ctd: ctd
            },
            success: function (response) {
                document.getElementById("cec").innerHTML = response;
            }
        });
    }

    function setCodeCec(code) {
        const last = code.value.toString().slice(-2);
        var principal = document.getElementById("Principal");
        var secondaire = document.getElementById("Secondaire");
        principal.checked = false;
        secondaire.checked = false;
        document.getElementById("code_cec").value = code.value;
        document.getElementById("code_cec_step2").value = code.value;
        document.getElementById("cec_step2").value = code.options[code.selectedIndex].innerHTML;
        if (last == "00" || last == "01") {
            principal.checked = true;
        } else {
            secondaire.checked = true;
        }
    }

    function getTypeActe(type) {
        $.ajax({
            type: "POST",
            url: "api.php",
            data: {
                IdType_cec: type
            },
            success: function (response) {
                console.log(type);
                document.getElementById("IdType_cec").innerHTML = response;
            }
        })
    }

    function getTotal(){
        var nai =document.getElementById("regnaissance").value;
        var mar = document.getElementById("regmariage").value;
        var dec = document.getElementById("regdeces").value;
        var total =parseInt(nai) + parseInt(mar) + parseInt(dec);
        console.log(total);
        document.getElementById("regtotal").value = total;
    }
    </script>

<script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery.steps.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/main.js"></script>




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