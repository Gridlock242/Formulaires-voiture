<?php
require_once("templates/header.php");
require_once("connectDB.php");
?>

<!-- Formulaire d'update d'une voiture par ID et son traitement -->

<!-- Vérification de l'ID dans l'URL -->
<?php if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    echo "ID reçu : " . $id;
}

// Exécute et récupère les résultats
$pdo = connectDB();
$requeteFetch = $pdo->prepare("SELECT * FROM car WHERE id = :id;");
$requeteFetch->execute(['id' => $_GET['id']]);
$car = $requeteFetch->fetch(PDO::FETCH_ASSOC);
$errors = [];

// Traitement du formulaire de mise à jour, si le formulaire a été validé
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['model'])) {
        $errors['model'] = 'le modèle ne peut pas être vide';
    }
    if (empty($_POST['brand'])) {
        $errors['brand'] = 'le modèle ne peut pas être vide';
    }
    if (empty($_POST['horsePower'])) {
        $errors['horsePower'] = 'le modèle ne peut pas être vide';
    }
    if (empty($_POST['image'])) {
        $errors['image'] = 'le modèle ne peut pas être vide';
    }
    if (empty($errors)) {
        $updateRequete = $pdo->prepare("UPDATE car SET model = :model, brand = :brand, horsePower = :horsePower, image = :image WHERE id = :id");
        $success = $updateRequete->execute([
            'model' => $_POST['model'],
            'brand' => $_POST['brand'],
            'horsePower' => $_POST['horsePower'],
            'image' => $_POST['image'],
            'id' => $id
        ]);
        if ($success) {
            header("Location: index.php");
            exit();
        } else {
            echo "Erreur lors de la mise à jour.";
        }
    }
}

?>


<form method="POST" action="update.php?id=<?= $id ?>">
    <label for="">Model</label>
    <input type="text" name="model" value="<?= $car['model'] ?>">
    <?php if (isset($errors['brand'])): ?>
        <p class="text-danger"><?= $errors['model'] ?></p>
    <?php endif; ?>

    <label for="">Brand</label>
    <input type="text" name="brand" value="<?= $car['brand'] ?>">
    <?php if (isset($errors['brand'])): ?>
        <p class="text-danger"><?= $errors['brand'] ?></p>
    <?php endif; ?>

    <label for="">HorsePower</label>
    <input type="text" name="horsePower" value="<?= $car['horsePower'] ?>">
    <?php if (isset($errors['brand'])): ?>
        <p class="text-danger"><?= $errors['horsePower'] ?></p>
    <?php endif; ?>

    <label for="">Image</label>
    <input type="text" name="image" value="<?= $car['image'] ?>">
    <?php if (isset($errors['brand'])): ?>
        <p class="text-danger"><?= $errors['image'] ?></p>
    <?php endif; ?>

    <button type="submit" class="btn btn-outline-success">Envoyer</button>

    <?php
    require_once("templates/footer.php");
    ?>