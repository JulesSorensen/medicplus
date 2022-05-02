<?php
function connectUser() {
    $_SESSION["online"] = TRUE;
    $_SESSION["coin"] = 200;
    header("refresh:0;url=index.php?p=home");
};
$id = "";
if (isset($_POST["accept"])) {
    if (isset($_POST['pseudo']) && isset($_POST['pass'])) {
        if (!empty($_POST['pseudo']) && !empty($_POST['pass'])) {
            if ($_POST['pseudo'] == "jules" && $_POST['pass'] == "dev") {
                connectUser();
            } else if ($_POST['pseudo'] == "yan" && $_POST['pass'] == "lebg") {
                connectUser();
            } else if ($_POST['pseudo'] == "lucas" && $_POST['pass'] == "rj45") {
                connectUser();
            } else {
                $id = "⚠ vous n'avez pas entré les bons identifiants ⚠";
            }
        } else {
            $id = "⚠ merci de compléter dans sa totalité le formulaire ⚠";
        }
    }
}

?>

<link rel="stylesheet" href="/style/login.css">
<div class="login-box">
    <h2>Login</h2>
    <form method="POST">
        <div class="user-box">
            <input type="text" name="pseudo" required="">
            <label>Pseudo</label>
        </div>
        <div class="user-box">
            <input type="password" name="pass" required="">
            <label>Mot de Passe</label>
        </div>
        <p><?php echo $id; ?></p>
        <button type="Submit" name="accept" class="fill">Connexion</button>
    </form>
</div>