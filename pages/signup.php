<?php
if (isset($_SESSION["online"])) { // deconnexion
    session_destroy();
}

if (isset($_POST["signupSubmit"])) {
    // connexion
    if (isset($_POST["name"]) && isset($_POST["lastname"]) && isset($_POST["mail"]) && isset($_POST["password"])) {
        $nom = addslashes(strtolower($_POST["name"]));
        $lastname = addslashes(strtolower($_POST["lastname"]));
        $mail = addslashes(strtolower($_POST["mail"]));
        $mdp = sha1($_POST["password"]);
        $trouve = FALSE;

        $req = "INSERT INTO `user` (`name`, `lastname`, `password`, `mail`, `type`)";
        $req .= " VALUES ('".$nom."', '".$lastname."', '".$mdp."', '".$mail."', 'usr')";
        $ORes = $Bdd->query($req);
        $Usr = $ORes->fetch();
        if ($ORes) {
            $trouve = TRUE;
            $_SESSION["online"] = true;
            $_SESSION["user"] = [
                "id" => $Usr->id,
                "name" => $Usr->name,
                "lastname" => $Usr->lastname,
                "mail" => $Usr->mail,
                "type" => $Usr->type,
            ];
        }

        if ($trouve) {
            header("Refresh:0; url=index.php?p=login");
        } else {
            $err = "Les informations sont incorrect.";
        }
    } else {
        $err = "Merci de rentrer les bonnes données.";
    }
}

?>

<title>Inscription</title>
<div class="loginPage h-screen w-screen flex justify-center">
    <div class="login-box w-[20rem] h-[25rem] flex flex-col justify-center align-middle m-auto p-5 bg-white rounded-lg">
        <div class="mt-[-50px] mb-[30px]">
            <img class="w-[7rem] m-auto" src="images/medicplus.png" alt="Medic+">
        </div>
        <h2 class="font-bold mx-auto mb-3">Espace d'inscription</h2>
        <p class="mx-auto text-red-500"><?php if (isset($err))  {echo $err; unset($err); } ?></p>
        <form method="POST" class="flex flex-col justify-center text-center">
            <div class="user-box flex flex-col mb-1">
                <label>Nom</label>
                <input class="bg-gray-100 rounded px-1" type="text" name="name" required>
            </div>
            <div class="user-box flex flex-col mb-1">
                <label>Prenom</label>
                <input class="bg-gray-100 rounded px-1" type="text" name="lastname" required>
            </div>
            <div class="user-box flex flex-col mb-1">
                <label>addresse mail</label>
                <input class="bg-gray-100 rounded px-1" type="mail" name="mail" required>
            </div>
            <div class="password-box flex flex-col mb-1">
                <label>Mot de Passe</label>
                <input class="bg-gray-100 rounded px-1" type="password" name="password" required>
            </div>
            <button type="submit" name="signupSubmit" class="mx-auto mt-3 p-1 bg-gray-100 hover:bg-gray-500 hover:text-white transition-all duration-500 text-black rounded">S'incrire</button>
            <a class="text-blue-200 hover:underline hover:decoration-wavy" href="login">J'ai déjà un compte</a>
        </form>
    </div>
</div>