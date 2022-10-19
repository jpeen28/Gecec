<?php
require "session.php";
require "dbconnexion.php";  
$stmt = $pdo->query("SELECT sum(nbrregnais) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='AD'");
$ada = $stmt->fetchColumn();
$stmt = $pdo->query("SELECT sum(nbrregnais) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='CE'");
$centre = $stmt->fetchColumn();
$stmt = $pdo->query("SELECT sum(nbrregnais) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='ES'");
$est = $stmt->fetchColumn();
$stmt = $pdo->query("SELECT sum(nbrregnais) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='EN'");
$ext = $stmt->fetchColumn();
$stmt = $pdo->query("SELECT sum(nbrregnais) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='LT'");
$litto = $stmt->fetchColumn();
$stmt = $pdo->query("SELECT sum(nbrregnais) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='NO'");
$nord = $stmt->fetchColumn();
$stmt = $pdo->query("SELECT sum(nbrregnais) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='NW'");
$nord_ou = $stmt->fetchColumn();
$stmt = $pdo->query("SELECT sum(nbrregnais) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='OU'");
$ouest = $stmt->fetchColumn();
$stmt = $pdo->query("SELECT sum(nbrregnais) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='SU'");
$sud = $stmt->fetchColumn();
$stmt = $pdo->query("SELECT sum(nbrregnais) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='SW'");
$sud_ou = $stmt->fetchColumn();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/main.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <title>GECEC MINDDEVEL | Tableau de Bord</title>
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
            <?php }?>

            <?php if($_SESSION['user']['role']=="administrateur") {?>
            <li>
                <a href="nouveau.php">
                    <i class='bx bx-plus'></i>
                    <span class="links_name">Nouveau</span>
                </a>
                <!-- Tooltip -->

                <span class="tooltip">Nouveau</span>
            </li>
            <?php }?>
            <?php if($_SESSION['user']['role']=="administrateur"  || $_SESSION['user']['role']=="departement" || $_SESSION['user']['role']=="region")  {?>
            <li>
                <a href="cartectd.php">
                    <i class='bx bx-map'></i>
                    <span class="links_name">Carte CTD</span>
                </a>
                <!-- Tooltip -->

                <span class="tooltip">Carte CTD</span>
            </li>
            <?php }?>
            <?php if($_SESSION['user']['role']=="administrateur"  || $_SESSION['user']['role']=="departement" || $_SESSION['user']['role']=="region")  {?>
            <li>
                <a href="hcollecte.php">
                    <i class='bx bx-edit'></i>
                    <span class="links_name">Edition</span>
                </a>
                <!-- Tooltip -->

                <span class="tooltip">Edition</span>
            </li>
            <?php }?>
            <?php if($_SESSION['user']['role']=="administrateur"){?>
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
                        <div class="job">MINDDEVEL</div>
                    </div>
                </div>
                <a href="deconnexion.php"><i class='bx bx-log-out' id="log-out" title="Deconnexion"></i></a>
            </div>
        </div>
    </div>
    <div class="home-content scroller">
        <div class="title-header">
            <h2 class="title-dashboard">TABLEAU STATISTIQUE DE L'ETAT CIVIL</h2>
        </div>
            <div class="graphe">
                <div class="graphnais">
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript">
                        google.charts.load("current", {packages:["corechart"]});
                        google.charts.setOnLoadCallback(drawChart);
                        function drawChart() { 
                            var data = google.visualization.arrayToDataTable([
                            ['Task', 'Hours per Day'],
                            ['Adamaoua', <?php echo $ada;?>],
                            ['Centre', <?php echo $centre;?>],
                            ['Est', <?php echo $est;?>],
                            ['Extreme Nord', <?php echo $ext;?>],
                            ['Littoral', <?php echo $litto;?>],
                            ['Nord', <?php echo $nord;?>],
                            ['Nord-Ouest', <?php echo $nord_ou;?>],
                            ['Ouest', <?php echo $ouest;?>],
                            ['Sud', <?php echo $sud;?>],
                            ['Sud-Ouest', <?php echo $sud_ou;?>],
                            ]);
                            var options = {
                            title: 'Nombre de Registre de Naissance par Region',
                            is3D: true,
                            };
                            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                            chart.draw(data, options);
                        }
                    </script>
                    <div id="piechart_3d" style="width: 48vw; height:45vh;"></div>
                </div>

                <div class="graphmar">

                <?php  
                    $stmt = $pdo->query("SELECT sum(nbractnai) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='AD'");
                    $ada = $stmt->fetchColumn();
                    $stmt = $pdo->query("SELECT sum(nbractnai) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='CE'");
                    $centre = $stmt->fetchColumn();
                    $stmt = $pdo->query("SELECT sum(nbractnai) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='ES'");
                    $est = $stmt->fetchColumn();
                    $stmt = $pdo->query("SELECT sum(nbractnai) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='EN'");
                    $ext = $stmt->fetchColumn();
                    $stmt = $pdo->query("SELECT sum(nbractnai) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='LT'");
                    $litto = $stmt->fetchColumn();
                    $stmt = $pdo->query("SELECT sum(nbractnai) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='NO'");
                    $nord = $stmt->fetchColumn();
                    $stmt = $pdo->query("SELECT sum(nbractnai) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='NW'");
                    $nord_ou = $stmt->fetchColumn();
                    $stmt = $pdo->query("SELECT sum(nbractnai) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='OU'");
                    $ouest = $stmt->fetchColumn();
                    $stmt = $pdo->query("SELECT sum(nbractnai) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='SU'");
                    $sud = $stmt->fetchColumn();
                    $stmt = $pdo->query("SELECT sum(nbractnai) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='SW'");
                    $sud_ou = $stmt->fetchColumn();
                ?>
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript">
                    google.charts.load("current", {packages:["corechart"]});
                    google.charts.setOnLoadCallback(drawChart);
                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                        ['Regions', 'Naissance par region'],
                        ['Adamaoua', <?php echo $ada;?>],
                                        ['Centre', <?php echo $centre;?>],
                                        ['Est', <?php echo $est;?>],
                                        ['Extreme Nord', <?php echo $ext;?>],
                                        ['Littoral', <?php echo $litto;?>],
                                        ['Nord', <?php echo $nord;?>],
                                        ['Nord-Ouest', <?php echo $nord_ou;?>],
                                        ['Ouest', <?php echo $ouest;?>],
                                        ['Sud', <?php echo $sud;?>],
                                        ['Sud-Ouest', <?php echo $sud_ou;?>],
                        ]);

                        var options = {
                        title: 'Nombre acte de Naissance par Region',
                        pieHole: 0.4,
                        };

                        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                        chart.draw(data, options);
                    }
                    </script>
                    <div id="donutchart" style="width: 48vw; height: 45vh;"></div>
                </div>
            </div>
            <div class="graphe2">
                <div class="graphdedec">
                    <?php  
                        $stmt = $pdo->query("SELECT sum(nbrregmar) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='AD'");
                        $ada = $stmt->fetchColumn();
                        $stmt = $pdo->query("SELECT sum(nbrregmar) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='CE'");
                        $centre = $stmt->fetchColumn();
                        $stmt = $pdo->query("SELECT sum(nbrregmar) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='ES'");
                        $est = $stmt->fetchColumn();
                        $stmt = $pdo->query("SELECT sum(nbrregmar) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='EN'");
                        $ext = $stmt->fetchColumn();
                        $stmt = $pdo->query("SELECT sum(nbrregmar) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='LT'");
                        $litto = $stmt->fetchColumn();
                        $stmt = $pdo->query("SELECT sum(nbrregmar) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='NO'");
                        $nord = $stmt->fetchColumn();
                        $stmt = $pdo->query("SELECT sum(nbrregmar) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='NW'");
                        $nord_ou = $stmt->fetchColumn();
                        $stmt = $pdo->query("SELECT sum(nbrregmar) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='OU'");
                        $ouest = $stmt->fetchColumn();
                        $stmt = $pdo->query("SELECT sum(nbrregmar) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='SU'");
                        $sud = $stmt->fetchColumn();
                        $stmt = $pdo->query("SELECT sum(nbrregmar) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='SW'");
                        $sud_ou = $stmt->fetchColumn();
                    ?>
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript">
                        google.charts.load('current', {'packages':['corechart']});
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {

                        var data = google.visualization.arrayToDataTable([
                            ['Regions', 'Mariage par region'],
                            ['Adamaoua', <?php echo $ada;?>],
                            ['Centre', <?php echo $centre;?>],
                            ['Est', <?php echo $est;?>],
                            ['Extreme Nord', <?php echo $ext;?>],
                            ['Littoral', <?php echo $litto;?>],
                            ['Nord', <?php echo $nord;?>],
                            ['Nord-Ouest', <?php echo $nord_ou;?>],
                            ['Ouest', <?php echo $ouest;?>],
                            ['Sud', <?php echo $sud;?>],
                            ['Sud-Ouest', <?php echo $sud_ou;?>],
                        ]);

                        var options = {
                        pieHole: 0.5,
                        pieSliceTextStyle: {
                            color: 'black',
                        },
                        title:'Nombre de Registre de Mariage par region'
                        };

                        var chart = new google.visualization.PieChart(document.getElementById('donut_single'));
                        chart.draw(data, options);
                    }
                    </script>
                    <div id="donut_single" style="width:48vw; height: 47vh;"></div>
                </div>
                <div class="grapheact">
                <?php  
                        $stmt = $pdo->query("SELECT sum(nbractmar) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='AD'");
                        $ada = $stmt->fetchColumn();
                        $stmt = $pdo->query("SELECT sum(nbractmar) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='CE'");
                        $centre = $stmt->fetchColumn();
                        $stmt = $pdo->query("SELECT sum(nbractmar) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='ES'");
                        $est = $stmt->fetchColumn();
                        $stmt = $pdo->query("SELECT sum(nbractmar) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='EN'");
                        $ext = $stmt->fetchColumn();
                        $stmt = $pdo->query("SELECT sum(nbractmar) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='LT'");
                        $litto = $stmt->fetchColumn();
                        $stmt = $pdo->query("SELECT sum(nbractmar) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='NO'");
                        $nord = $stmt->fetchColumn();
                        $stmt = $pdo->query("SELECT sum(nbractmar) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='NW'");
                        $nord_ou = $stmt->fetchColumn();
                        $stmt = $pdo->query("SELECT sum(nbractmar) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='OU'");
                        $ouest = $stmt->fetchColumn();
                        $stmt = $pdo->query("SELECT sum(nbractmar) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='SU'");
                        $sud = $stmt->fetchColumn();
                        $stmt = $pdo->query("SELECT sum(nbractmar) FROM statistique INNER JOIN cec ON statistique.code=cec.code WHERE code_region='SW'");
                        $sud_ou = $stmt->fetchColumn();
                    ?>
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript">
                    google.charts.load("current", {packages:["corechart"]});
                    google.charts.setOnLoadCallback(drawChart);
                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Regions', 'Mariage par region'],
                                        ['Adamaoua', <?php echo $ada;?>],
                                        ['Centre', <?php echo $centre;?>],
                                        ['Est', <?php echo $est;?>],
                                        ['Extreme Nord', <?php echo $ext;?>],
                                        ['Littoral', <?php echo $litto;?>],
                                        ['Nord', <?php echo $nord;?>],
                                        ['Nord-Ouest', <?php echo $nord_ou;?>],
                                        ['Ouest', <?php echo $ouest;?>],
                                        ['Sud', <?php echo $sud;?>],
                                        ['Sud-Ouest', <?php echo $sud_ou;?>],
                        ]);

                        var options = {
                            title: 'Nombre acte de Mariage par Region',
                            pieStartAngle: 100,
                        };

                            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                            chart.draw(data, options);
                        }
                        </script>
                        <div id="piechart" style="width:48vw; height:47vh;"></div>
                    </div>
                </div>
            </div>
            <div class="graphe3">
                
            </div>
        
         </div>
    <div>
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
        </div>
    
</body>

</html>