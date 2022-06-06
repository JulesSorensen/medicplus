<?php
//POST NOM/PRENOM = name
//POST EMAIL = email 
//POST DATE = date  
//POST LIEU = lieu 
//POST RESUME = resume
//POST SUBMIT = btnsub

$postTab = [];
print '<form action="post">
    <div class="form1">
        <label for="name">Nom / Prénom :</label>
        <input name="name" id="name" type="text">

        <label for="email">Addresse Mail :</label>
        <input name="email" id="email" type="mail">

        <label for="date">Date :</label>
        <input name="date" id="date" type="date">

        <label for="lieu">Lieu :</label>
        <input name="lieu" id="lieu" type="text">

        <label for="resume">Résumé :</label>
        <textarea name="resume" id="resume"></textarea>

        <label for="medecins">Médecins :</label>
        <select name="medecins" id="medecins">';
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
                print "test";
                print "<option value='$key->userid'>".$key->name."</option>";
            }
            

        print'</select>

        <button type="submit" name="btnsub" id="btnsub"><a class="md:p-4 py-2 block hover:text-gray-400" href="?p=planif">Envoyer</a></button>
    </div>
</form>';


if (isset($_POST['btnsub'])) {
    $sql = "INSERT INTO `meet`(`clientName`)";
    $sql .= " VALUES ('".$_POST['name']."')";

    $result = $Bdd->query($sql);
    $result->fetch();

}

?>

