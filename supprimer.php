<?php
require 'dbconnexion.php';
$id = $_GET['id'];
$sql = 'DELETE FROM statistique WHERE id=:id';
$statement = $connection->prepare($sql);
if ($statement->execute([':id' => $id])) {
  header("Location:hcollecte.php");
}
?>

<?php
$id = $_GET['id'];
$sql = 'DELETE FROM nouveaucec WHERE id=:id';
$statement = $connection->prepare($sql);
if ($statement->execute([':id' => $id])) {
  header("Location:dashboard.php");
}
?>
<?php
$id = $_GET['id'];
$sql = 'DELETE FROM nouveauoec WHERE id=:id';
$statement = $connection->prepare($sql);
if ($statement->execute([':id' => $id])) {
  header("Location:dashboard.php");
}
?>

<?php
$id = $_GET['id'];
$sql = 'DELETE FROM user WHERE id=:id';
$statement = $connection->prepare($sql);
if ($statement->execute([':id' => $id])) {
  header("Location:utilisateur.php");
}
?>