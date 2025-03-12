<?php
require_once("templates/header.php");
require_once("connectDB.php");
?>

<?php 
if(isset($_SESSION["username"])) {
    // Supprime une variable
    unset($_SESSION["username"]);
}

// Vide les données de la session en conservant la même session
// session_reset();

// Détruit la session totale, une nouvelle session sera créée avec un nouvel ID
// session_destroy();

header("Location: index.php")

?>

<?php
require_once("templates/footer.php");
?>