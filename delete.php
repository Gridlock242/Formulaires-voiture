<?php
require_once("templates/header.php");
require_once("connectDB.php");
?>

<!-- Vérification de l'ID dans l'URL -->
<?php
if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
}

// Sélectionner la voiture avec l'ID rentré
$pdo = connectDB();
$requeteSelect = $pdo->prepare("SELECT * FROM car WHERE id = :id");
$requeteSelect->execute(['id' => $_GET['id']]);
$car = $requeteSelect->fetch(PDO::FETCH_ASSOC);

// Requête de suppression
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = connectDB();
    $requeteDelete = $pdo->prepare("DELETE FROM car WHERE id = :id;");
    $requeteDelete->execute(['id' => $_GET['id']]);
    // Redirige l'utilisateur si la suppression a eu lieu
    header("Location: index.php");
    exit;
}
?>

<!-- Formulaire de suppression d'une voiture par ID et son traitement -->
<h1>Confirmer la suppression de <?= $car['brand'] ?> <?= $car['model'] ?> ?</h1>
<form method="POST" action="delete.php?id=<?= $_GET["id"] ?>">
    <button type="submit" class="btn btn-danger">Delete</button>
    <button type="submit" class="btn btn-secondary" formaction="index.php">Cancel</button>
</form>

<?php
require_once("templates/footer.php");
?>