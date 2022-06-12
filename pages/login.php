<?php
if (isset($_SESSION["online"])) { // deconnexion
    session_destroy();
}

if (isset($_POST["loginSubmit"])) {
    // connexion
    if (isset($_POST["name"]) && isset($_POST["password"])) {
        $nom = addslashes(strtolower($_POST["name"]));
        $mdp = sha1($_POST["password"]);
        $trouve = FALSE;

        $req = "SELECT * FROM user WHERE name = '$nom' OR mail = '$nom'";
        $ORes = $Bdd->query($req);
        if ($ORes) {
            if ($Usr = $ORes->fetch()) {
                if ($Usr->password == $mdp) {
                    $trouve = TRUE;
                    $_SESSION["online"] = true;
                    $_SESSION["user"] = [
                        "id" => $Usr->id,
                        "name" => $Usr->name,
                        "type" => $Usr->type,
                    ];
                }
            }
        }

        if ($trouve) {
            header("Refresh:0; url=index.php?p=home");
        } else {
            $err = "Nom ou mot de passe incorrect.";
        }
    } else {
        $err = "Merci de rentrer votre nom et mot de passe.";
    }
}

?>

<title>Connexion</title>
<div class="loginPage h-screen w-screen flex justify-center">
    <div class="login-box w-[20rem] h-[20rem] flex flex-col justify-center align-middle m-auto p-5 bg-white rounded-lg">
        <img class="w-20 m-auto" src="images/medicplus.png" alt="Medic+">
        <h2 class="font-bold mx-auto mb-3">Espace de connexion</h2>
        <p class="mx-auto text-red-500"><?php if (isset($err))  {echo $err; unset($err); } ?></p>
        <form method="POST" class="flex flex-col justify-center">
            <div class="user-box flex flex-col mb-1">
                <label>Nom ou email</label>
                <input class="bg-gray-100 rounded px-1" type="text" name="name" required>
            </div>
            <div class="password-box flex flex-col mb-1">
                <label>Mot de Passe</label>
                <input class="bg-gray-100 rounded px-1" type="password" name="password" required>
            </div>
            <button type="submit" name="loginSubmit" class="mx-auto mt-3 p-1 bg-gray-100 hover:bg-gray-500 hover:text-white transition-all duration-500 text-black rounded">Connexion</button>
        </form>
    </div>
</div>