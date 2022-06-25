<?php

if (isset($_POST['btnsub'])) {

    if(!isset($_POST['valid']))$_POST['valid'] = 'false';

    $sql = "INSERT INTO `meet` (`userid`, `clientName`, `clientLastname`, `clientMail`, `date`, `place`, `resume`, `qcm`, `validated`)";
    $sql .= " VALUES (".$_POST['medecins']."";
    $sql .= ", '".$_POST['name']."'";
    $sql .= ", '".$_POST['lastname']."'";
    $sql .= ", '".$_POST['email']."'";
    $sql .= ", '".$_POST['date']." ".$_POST["hour"]."'";
    $sql .= ", '".$_POST['lieu']."'";
    $sql .= ", '".$_POST['resume']."'";
    $sql .= ", ''";
    $sql .= ", ".$_POST['valid'].")";



    $result = $Bdd->query($sql);
    $result->fetch();

    $msg = "Le rendez-vous de " . $_POST['name'] . " a bien été validé";

} else if (isset($_POST['btnsave'])) {

    if(!isset($_POST['valid']))$_POST['valid'] = 'false';
    $_GET['edit'] = $_POST['btnsave'];
    $id = $_POST['btnsave'];

    $sql = "UPDATE `meet`";
    $sql .= " SET `userid` = ".$_POST['medecins']."";
    $sql .= ", `clientName` = \"".$_POST['name']."\"";
    $sql .= ", `clientLastname` = \"".$_POST['lastname']."\"";
    $sql .= ", `clientMail` = \"".$_POST['email']."\"";
    $sql .= ", `date` = \"".$_POST['date']." ".$_POST["hour"]."\"";
    $sql .= ", `place` = \"".$_POST['lieu']."\"";
    $sql .= ", `resume` = \"".$_POST['resume']."\"";
    $sql .= ", `qcm` = \"\"";
    $sql .= ", `validated` = ".$_POST['valid']."";
    $sql .= " WHERE id = ".$id."";

    // print $sql;
    // exit();

    $result = $Bdd->query($sql);
    $result->fetch();

    $msg = "Le rendez-vous de " . $_POST['name'] . " a bien été mis à jour";
}

if (isset($_GET['edit'])) {

    $id = $_GET['edit'];

    $sql = "SELECT *";
    $sql .= " FROM `meet`";
    $sql .= " WHERE `id`=$id";

    $result = $Bdd->query($sql);

    if ($Rdv = $result->fetch()) {

        print '<title>Plannification</title>
            <form method="post">
            <div class="form1 h-screen flex justify-center flex-col px-96">';
            if (isset($msg)) {
                print'<p class="text-green-500 mx-auto">'.$msg.'</p>';
                unset($msg);
            }  
                print'<label for="name">Prénom :</label>
                <input class="rounded pl-1" name="name" id="name" type="text" value="'; 
                    print''.$Rdv->clientName.'';
                print'" required>
        
                <label for="name">Nom :</label>
                <input class="rounded pl-1" name="lastname" id="lastname" type="text" value="'; 
                print''.$Rdv->clientLastname.'';
                print'" required>
        
                <label for="email">Addresse Mail :</label>
                <input class="rounded pl-1" name="email" id="email" type="mail" value="';
                    print''.$Rdv->clientMail.'';
                print'" required>
        
                <label for="date">Date :</label>
                <input class="rounded pl-1" name="date" id="date" type="date" value="';
                    print''.explode(' ', $Rdv->date)[0].'';
                print'" required>
        
                <label for="hour">Heure :</label>
                <input class="rounded pl-1" name="hour" id="hour" type="time" value="';
                    print''.explode(' ', $Rdv->date)[1].'';
                print'" required>
        
                <label for="lieu">Lieu :</label>
                <input class="rounded pl-1" name="lieu" id="lieu" type="text" value="';
                    print''.$Rdv->place.'';
                print'" required>
        
                <label for="resume">Résumé :</label>
                <textarea class="rounded pl-1" name="resume" id="resume" value="';
                    print"".$Rdv->resume."";
                print'">'.$Rdv->resume.'</textarea>
        
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
                print'</select>';
                if($_SESSION['user']['type'] == 'sec' && $Rdv->validated != true){
                    print'<div class="flex flex-row items-center align-middle"><label for="valid">Valider le Rendez-vous</label>
                    <input class="ml-3" id="valid" name="valid" value=true type="checkbox"></div>';
                }
                print'<button class="rounded bg-white m-3 w-52 mx-auto md:p-4 py-2 hover:bg-green-500 hover:text-black" type="submit" name="btnsave" id="btnsave" value="'.$id.'">Sauvegarder</button>
            </div>
        </form>';
    }
} else {

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
                print''.$_SESSION['user']['name'].'';
            }
            print'" required>
    
            <label for="name">Nom :</label>
            <input class="rounded pl-1" name="lastname" id="lastname" type="text" value="'; 
            if($_SESSION['user']['type'] == 'usr'){
                print''.$_SESSION['user']['lastname'].'';
            }
            print'" required>
    
            <label for="email">Addresse Mail :</label>
            <input class="rounded pl-1" name="email" id="email" type="mail" value="'; 
            if($_SESSION['user']['type'] == 'usr'){
                print''.$_SESSION['user']['mail'].'';
            }
            print'" required>
    
            <label for="date">Date :</label>
            <input class="rounded pl-1" name="date" id="date" type="date" required>
    
            <label for="hour">Heure :</label>
            <input class="rounded pl-1" name="hour" id="hour" type="time" required>
    
            <label for="lieu">Lieu :</label>
            <input class="rounded pl-1" name="lieu" id="lieu" type="text" required>
    
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
            print'</select>';
            if($_SESSION['user']['type'] == 'sec'){
                print'<div class="flex flex-row items-center align-middle"><label for="valid">Valider le Rendez-vous</label>
                <input class="ml-3" id="valid" name="valid" value=true type="checkbox"></div>';
            }
            print'<button class="rounded bg-white m-3 w-52 mx-auto md:p-4 py-2 hover:bg-green-500 hover:text-black" type="submit" name="btnsub" id="btnsub">Envoyer</button>
        </div>
    </form>';
}


?>