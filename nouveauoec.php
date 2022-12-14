<?php
require_once("dbconnexion.php");
session_start();
    $stmt = $pdo->query("SELECT * FROM region");
    $regions = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <title>GECEC MINDDEVEL | Nouveau OEC</title>
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
        <div class="bar-nav">
            <ul class="nbar">
                <li class="nlist">
                    <a class="nlink" href="nouveau.php">Nouveau CEC</a>
                </li>
                <li class="nlist">
                    <a class="nlink" href="nouveauoec.php">Nouveau OEC</a>
                </li>
            </ul>
        </div>
        
        <div class="nouveaucec">
            <div class="form-new-cec">
                <h2 class="title">Ajouter un nouveau officier d'etat civil
                    <h5 class="description">Verifier que tous les champs soient remplis avant de soumettre le formulaire</h5>
                </h2>
                <form action="enregistrementoec.php" method="post" class="new-cec-form">
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
                    <select class="select" name="localite" id="cec" onchange="setCodeCec(this.value)" required onchange="getCode()">
                        <option value disabled selected>Selectionner une localite</option>
                    </select>
                    <input type="text" name="nomoec" id="nomoec" placeholder="Nom & Prenom" class="input" required>
                    <input type="text" name="ref" id="ref" placeholder="Reference " class="input" required>
                    <input type="file" name="upload" id="upload" class="input" title="arret?? de nomination">
                    <select name="poste" id="poste"class="select" required>
                        <option value disabled selected>-- Choisir un poste --</option>
                        <option value="Principal">Officier d'etat civil</option>
                        <option value="Secondaire">Secretaire d'etat civil</option>
                    </select>
                    <div class="bnt-ctrl">
                        <input type="reset" value="Annuler" id="danger">
                        <input type="submit" value="Sauvegarder" id="ok" onclick="confirm('voulez confirmer cette information ?')">
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