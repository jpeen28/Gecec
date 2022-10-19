<?php
require "dbconnexion.php";
require "session.php";
$stmt = $pdo->query("SELECT * FROM region");
$regions = $stmt->fetchAll();

$stmt = $pdo->query("SELECT * FROM departements");
$dept = $stmt->fetchAll();

$bdd = new PDO('mysql:host=localhost;dbname=minddevel;', 'root', '');
$sql = $bdd->query("SELECT * FROM statistique INNER JOIN cec ON statistique.code=cec.code where true");
if(isset($_GET['region'])){
    $region = htmlspecialchars($_GET['region']);
    $sql = $bdd->query('select * from statistique where code like"%'.$region.'%"');
}
if(isset($_GET['etat'])){
    $etat = htmlspecialchars($_GET['etat']);
    $sql = $bdd->query("SELECT * FROM statistique WHERE fonctionnel ='$etat'");
}

if(isset($_GET['date']) && ($_GET['date1']) ){
    $date = htmlspecialchars($_GET['date']);
    $date1 = htmlspecialchars($_GET['date1']);
    $sql = $bdd->query("SELECT * FROM statistique WHERE datecreation BETWEEN '$date' AND '$date1'");
}

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/table.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <title>GECEC MINDDEVEL | Historiques CEC</title>
</head>

<body class="img js-fullheight" style="background-image: url(img/img1.jpg);" id="bodyp">
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
            <?php if($_SESSION['user']['role']=="administrateur"){?>
            <li>
                <a href="nouveau.php">
                    <i class='bx bx-plus'></i>
                    <span class="links_name">Nouveau</span>
                </a>
                <!-- Tooltip -->

                <span class="tooltip">Nouveau</span>
            </li>
            <?php } ?>
            <?php if($_SESSION['user']['role']=="administrateur" || $_SESSION['user']['role']=="departement" || $_SESSION['user']['role']=="region"){?>
            <li>
                <a href="cartectd.php">
                    <i class='bx bx-map'></i>
                    <span class="links_name">Carte CTD</span>
                </a>
                <!-- Tooltip -->

                <span class="tooltip">Carte CTD</span>
            </li>
            <?php } ?>
            <?php if($_SESSION['user']['role']=="administrateur" || $_SESSION['user']['role']=="departement" || $_SESSION['user']['role']=="region"){?>
            <li>
                <a href="hcollecte.php">
                    <i class='bx bx-edit'></i>
                    <span class="links_name">Edition</span>
                </a>
                <!-- Tooltip -->

                <span class="tooltip">Edition</span>
            </li>
            <?php } ?>
            <?php if($_SESSION['user']['role']=="administrateur"){?>
            <li>
                <a href="utilisateur.php">
                    <i class='bx bxs-user'></i>
                    <span class="links_name">Utilisateurs</span>
                </a>
                <!-- Tooltip -->

                <span class="tooltip">Utilisateurs</span>
            </li>
            <?php } ?>
           
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
        <ul class="navigation">
            <li class="navi">
                <a href="hcollecte.php" class="link">Collecte</a>
            </li>
            <li class="navi">
                <a href="hnouveaucec.php" class="link">Nouveau CEC</a>
            </li>
            <li class="navi">
                <a href="hnouveauoec.php" class="link">Nouveau OEC</a>
            </li>
        </ul>
        <div class="container hcollecte">
            <div class="card mt-5 tab" id="print" >
                <div class="card-header print">
                    <form action="" method="get">
                        <select name="region" id="region">
                            <option value disable selected>Selectionner la region</option>
                            <?php foreach ($regions as $region) { ?>
                                <option value="<?= $region['code_region'] ?>"><?= $region['FR'] ?></option>
                            <?php }?>
                        </select>
                        <select name="departement" id="departement">
                            <option value disable selected>Selectionner un departement</option>
                            <?php foreach ($dept as $depart) { ?>
                                <option value="<?= $depart['code_dept'] ?>"><?= $depart['FR'] ?></option>
                            <?php }?>
                        </select>
                        <button type="submit">
                        <img src="img/right-arrow.png" width="20px" height="20px" title="Rechercher">
                    </button>
                        
                    </form>

                    <form action="" method="get">
                       <label for="">De:</label>
                        <input type="date" name="date" id="date">
                        <label for="">A:</label>
                        <input type="date" name="date1" id="date1">
                        <button type="submit">
                            <img src="img/right-arrow.png" width="20px" height="20px" title="Rechercher">
                        </button>
                        
                    </form>
                    <form action="" method="get">
                       <select name="etat" id="etat">
                            <option value disable selected>Etat du centre</option>
                            <option value="Fonctionnel">Fonctionnel</option>
                            <option value="Non Fonctionnel">Non Fonctionnel</option>
                       </select>
                       <button type="submit">
                            <img src="img/right-arrow.png" width="20px" height="20px" title="Rechercher">
                        </button>
                        
                    </form>
                    <div>
                    <button onclick="printPage()">
                        <img src="img/printer.png" width="30px" height="30px" title="imprimer">
                    </button>
                    </div>
                </div>
                <div class="card-body Scroll">
                    <table class="table table-bordered">
                        <tr class="header-tab">
                            <th>N°</th>
                            <th>Date d'enregistrement</th>
                            <th>Localite</th>
                            <th>Code</th>
                            <th>Registre Naissance</th>
                            <th>Registre Mariage</th>
                            <th>Registre Deces</th>
                            <th>Registre Paraphés</th>
                            <th>Registre Cloturés</th>
                            <th>Acte de Mariage</th>
                            <th>Acte de Naissance</th>
                            <th>Acte de Deces</th>
                            <th>Observation</th>
                            <th>Etat du Centre</th>
                            <th id="action">Action</th>
                        </tr>
                        <tbody>
                        <?php
                            if($sql->rowCount() > 0){
                                while($user = $sql->fetch()){
                                    ?>
                                        <tr>
                                            <td><?= $user['id'];?></td>
                                            <td><?= $user['datecreation'];?></td>
                                            <td><?= $user['Localite'];?></td>
                                            <td><?= $user['code'];?></td>
                                            <td><?= $user['nbrregnais'];?></td>
                                            <td><?= $user['nbrregmar'];?></td>
                                            <td><?= $user['nbrregdec'];?></td>
                                            <td><?= $user['nbrregpara'];?></td>
                                            <td><?= $user['nbrregclot'];?></td>
                                            <td><?= $user['nbractnai'];?></td>
                                            <td><?= $user['nbractmar'];?></td>
                                            <td><?= $user['nbractdec'];?></td>
                                            <td><?= $user['commentaire'];?></td>
                                            <td><?= $user['fonctionnel'];?></td>
                                            <td>
                                                <a href="modifier.php?id=<?= $user['id'] ?>" ><img src="./img/pen.png" style="width:20px" title="modifier"></a>
                                                <a onclick="return confirm('Voulez vous vraiment supprimer cette information ?')" href="supprimer.php"><img src="./img/delete.png" style="width:20px;" title="supprimer"></a>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            }
                            else{
                                ?>
                                <p>Aucun resultat trouve</p>
                                <?php
                            }
                        ?>
                  </tbody>
                        <tr>
                            <th>Total</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><?php
                            $stmt = $pdo->query("SELECT SUM(nbrregnais)FROM statistique");
                            $zu = $stmt->fetchColumn();
                            print_r($zu);
                           ?></td>
                            <td><?php
                            $stmt = $pdo->query("SELECT SUM(nbrregmar)FROM statistique");
                            $zu = $stmt->fetchColumn();
                            print_r($zu);
                           ?></td>
                            <td><?php
                            $stmt = $pdo->query("SELECT SUM(nbrregdec)FROM statistique");
                            $zu = $stmt->fetchColumn();
                            print_r($zu);
                           ?></td>
                            <td><?php
                            $stmt = $pdo->query("SELECT SUM(nbrregpara)FROM statistique");
                            $zu = $stmt->fetchColumn();
                            print_r($zu);
                           ?></td>
                            <td><?php
                            $stmt = $pdo->query("SELECT SUM(nbrregclot)FROM statistique");
                            $zu = $stmt->fetchColumn();
                            print_r($zu);
                           ?></td>
                            <td><?php
                            $stmt = $pdo->query("SELECT SUM(nbractmar)FROM statistique");
                            $zu = $stmt->fetchColumn();
                            print_r($zu);
                           ?></td>
                            <td><?php
                            $stmt = $pdo->query("SELECT SUM(nbractnai)FROM statistique");
                            $zu = $stmt->fetchColumn();
                            print_r($zu);
                           ?></td>
                            <td><?php
                            $stmt = $pdo->query("SELECT SUM(nbractdec)FROM statistique");
                            $zu = $stmt->fetchColumn();
                            print_r($zu);
                           ?></td>
                        </tr>
                        
                    </table>
                </div>
        </div>
    </div>
    <script type="text/javascript">
        function printPage(){
            var body = document.getElementById('bodyp').innerHTML;
            var print = document.getElementById('print').innerHTML;
            document.getElementById('bodyp').innerHTML = print;
           
            window.print();
            
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