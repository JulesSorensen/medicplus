<?php
//POST NOM/PRENOM = name
//POST EMAIL = email 
//POST DATE = date  
//POST LIEU = lieu 
//POST RESUME = resume
//POST SUBMIT = btnsub

if (isset($_POST['btnsub'])) {
    $sql = "INSERT INTO `meet` (`userId`, `clientName`, `clientLastname`, `clientMail`, `date`, `place`, `resume`, `qcm`, `validated`)";
    $sql .= " VALUES (".$_POST['medecins'].", '".$_POST['name']."', '".$_POST['lastname']."', '".$_POST['email']."', '".$_POST['date']." ".$_POST["hour"]."', '".$_POST['lieu']."', '".$_POST['resume']."', '', true)";

    $result = $Bdd->query($sql);
    $result->fetch();
    $msg = "Le rendez-vous de " . $_POST['name'] . " a bien été validé";
}

print '<title>Plannification</title>
    <form method="post">
    <div class="form1 h-screen flex justify-center flex-col px-96">';

    if (isset($msg)) {
        print'<p class="text-green-500 mx-auto">'.$msg.'</p>';
        unset($msg);
    }

        print'<label for="name">Prénom :</label>
        <input class="rounded pl-1" name="name" id="name" type="text" value="'; 
        if($_SESSION['user']['type'] == 'usr'){
            print"".$_SESSION['user']['name']."";
        }
        print'">

        <label for="name">Nom :</label>
        <input class="rounded pl-1" name="lastname" id="lastname" type="text" value="'; 
        if($_SESSION['user']['type'] == 'usr'){
            print"".$_SESSION['user']['lastname']."";
        }
        print'">

        <label for="email">Addresse Mail :</label>
        <input class="rounded pl-1" name="email" id="email" type="mail" value="'; 
        if($_SESSION['user']['type'] == 'usr'){
            print"".$_SESSION['user']['mail']."";
        }
        print'">

        <label for="date">Date :</label>
        <input class="rounded pl-1" name="date" id="date" type="date">

        <label for="hour">Heure :</label>
        <input class="rounded pl-1" name="hour" id="hour" type="time">

        <label for="lieu">Lieu :</label>
        <input class="rounded pl-1" name="lieu" id="lieu" type="text">

        <label for="resume">Résumé :</label>
        <textarea class="rounded pl-1" name="resume" id="resume"></textarea>

        <label for="medecins">Médecins :</label>
        <select class="rounded pl-1" name="medecins" id="medecins">';
            $medecins = [];

            $sql = "SELECT * FROM user ";
            $sql .= " WHERE type = 'med'";

            $result = $Bdd->query($sql);
            $med = $result->fetch();

            while($med != null){
                array_push($medecins, $med);
                $med = $result->fetch();
            }

            foreach ($medecins as $key) {
                print "<option value='$key->id'>".$key->name."</option>";
            }
        print'</select>
        <button class="rounded bg-white m-3 w-52 mx-auto md:p-4 py-2 hover:bg-green-500 hover:text-black" type="submit" name="btnsub" id="btnsub">Envoyer</button>
    </div>
</form>';

?>