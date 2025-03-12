<?php
require_once("templates/header.php");
require_once("connectDB.php");
?>

<a href="add.php" class="btn btn-success">Ajouter une voiture</a>

<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
}
?>

<h1>Hello <?= $_SESSION["username"] ?> admin</h1>

<?php

// Code de vérification de session


//La variable $pdo représente la connexion à la BDD
$pdo = connectDB();
//Prépare la requête pour récuperer toutes les voitures
$requete = $pdo->query("SELECT * FROM car;");
//Exécute et récupère les résultats
$cars = $requete->fetchAll();



foreach ($cars as $car) { ?>
    <div class="d-flex align-items-start justify-content-evenly border-top">
        <img src="images/<?= $car["image"] ?>" alt="<?= $car["model"] ?>">
        <h1><?= $car["model"] ?></h1>
        <h2><?= $car["brand"] ?></h2>
        <p><?= $car["horsePower"] ?></p>
        <a href="update.php?id=<?= $car["id"] ?>" class="btn btn-primary">Modifier</a>
        <a href="delete.php?id=<?= $car["id"] ?>" class="btn btn-danger">Supprimer</a>
    </div>
<?php } ?>

<?php
require_once("templates/footer.php");
?>