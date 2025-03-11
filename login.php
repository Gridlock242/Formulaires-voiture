<?php
require_once("templates/header.php");
require_once("connectDB.php");
?>

<?php
$pass = password_hash("admin", PASSWORD_DEFAULT);
var_dump($pass);
?>

<!-- Stockage des erreurs dans un tableau -->
<?php $errors = []; ?>

<!-- 2) Vérifier les données provenant du formulaire lorsqu'il est validé/soumis -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 3) Vérifier les champs pour créer des erreurs
    // Vérifie que le champ USERNAME est défini et non vide, et aussi que sa longueur n'est pas inférieure à 0
    if (isset($_POST["username"]) == false || strlen($_POST["username"]) <= 4) {
        $errors["username"] = ("Erreur inférieur à 4, problème Username");
    }
    if (isset($_POST["password"]) == false || strlen($_POST["username"]) <= 4) {
        $errors["password"] = ("Erreur inférieur à 4, problème Password");
    }
    // 4) Si il n'y a pas d'erreurs :
    if(empty($errors)) {

    }
    // Connexion

// 1. Recherche en base de données de la correspondance d’un utilisateur avec le « username » du formulaire

// 2. Si un utilisateur avec le même username est trouvé en BDD:

// 3. Vérification du mot du mot de passe provenant du formulaire et celui en BDD avec cette fonction:
    // password_verify($_POST["password"], $res["password"])
    // Renvoie TRUE si les mots de passe correspondent

// 4. Si les vérifications sont correctes, connexion de l’utilisateur:
    // Enregistrement en session de son username, redirection vers admin.php
    // session_start();
    // $_SESSION["username"] = $user["username"];
    // header('Location: admin.php')

}
?>


<!-- Recherche en base de données de la correspondance d’un utilisateur avec le « username »
du formulaire -->
<!-- Si un utilisateur avec le même username est trouvé en BDD -->
<!-- if($username) ... -->

<!-- Formulaire de connexion -->
<form method="POST" action="login.php">
    <label>Username</label>
    <input type="text" name="username">

    <?php if(isset($errors['username'])): ?>
        <p class="text-danger">
            <?=$errors['username'] ?>
        </p>
    <?php endif; ?>

    <label>Password</label>
    <input type="password" name="password">

    <?php if(isset($errors['password'])): ?>
        <p class="text-danger">
            <?=$errors['password'] ?>
        </p>
    <?php endif; ?>

    <button class="btn btn-outline-success">Se connecter</button>
</form>

<?php
require_once("templates/footer.php");
?>