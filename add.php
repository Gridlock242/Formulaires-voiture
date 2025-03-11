<?php
require_once("templates/header.php");
require_once("connectDB.php");
?>

<?php

$errors = [];
// Si le formulaire à été validé / Validation des données
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
     if(empty($errors)) {
    require_once("connectDB.php");
    $pdo = connectDB();
    $requete = $pdo->prepare("INSERT INTO car(model, brand, horsePower, image) 
                        VALUES(:model, :brand, :horsePower, :image);");
    $requete->execute([
        'model' => $_POST['model'],
        'brand' => $_POST['brand'],
        'horsePower' => $_POST['horsePower'],
        'image' => $_POST['image'],
    ]);
    header('Location: index.php');
    }
} ?>

<h1>Ajoutez un nouveau modèle de voiture</h1>

 <form method="POST" action="add.php" class="">
    <label for="">Model</label>
    <input type="text" name="model" required>
    <?php if (isset($errors['model'])): ?>
        <p class="text-danger"><?= $errors['model'] ?></p>
    <?php endif; ?>

    <label for="">Brand</label>
    <input type="text" name="brand" required>
    <?php if (isset($errors['brand'])): ?>
        <p class="text-danger"><?= $errors['brand'] ?></p>
    <?php endif; ?>

    <label for="">HorsePower</label>
    <input type="text" name="horsePower" required>
    <?php if (isset($errors['horsePower'])): ?>
        <p class="text-danger"><?= $errors['horsePower'] ?></p>
    <?php endif; ?>

    <label for="">Image</label>
    <input type="text" name="image" required>
    <?php if (isset($errors['image'])): ?>
        <p class="text-danger"><?= $errors['image'] ?></p>
    <?php endif; ?>

    <button type="submit" class="btn btn-outline-success">Envoyer</button>
</form>

<?php var_dump($errors); ?>

<?php
require_once("templates/footer.php");
?>