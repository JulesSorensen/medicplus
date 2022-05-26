<?php
if (isset($_POST["loginSubmit"])) {
    // connexion
}

?>

<title>Connexion</title>
<div class="loginPage h-full w-full flex justify-center">
    <div class="login-box w-[20rem] h-[20rem] flex flex-col justify-center align-middle m-auto p-5 bg-white rounded-lg">
        <img class="w-20 m-auto" src="images/medicplus.png" alt="Medic+">
        <h2 class="font-bold mx-auto mb-3">Espace de connexion</h2>
        <form method="POST" class="flex flex-col justify-center">
            <div class="user-box flex flex-col mb-1">
                <label>Nom</label>
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