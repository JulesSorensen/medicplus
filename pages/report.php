<?php
    if (isset($_POST["btnsave"])) {
        if ($_SESSION['user']['type'] != "usr") {
            $_GET['edit'] = $_POST['btnsave'];
            $id = $_POST['btnsave'];
    
            $qcm = "";
            for ($i=1; $i <= 3; $i++) {
                $q = $_POST["question-".$i];
                $r = $_POST["reponse-".$i];
                switch ($i) {
                    case 1:
                        $qcm .= "$q::$r";
                        break;
                    default:
                        $qcm .= ";;$q::$r";
                        break;
                }
            }
    
            $sql = "UPDATE `meet`";
            $sql .= " SET `resume` = \"".$_POST['resume']."\"";
            $sql .= ", `qcm` = \"".$qcm."\"";
            $sql .= " WHERE id = ".$id."";
            $result = $Bdd->query($sql);
            $result->fetch();
    
            $msg = "Le compte rendu a bien été mis à jour.";
        }
    }
?>

<title>Compte-rendu</title>
<div class="container mx-auto py-3 h-screen">
    <div class="wrapper bg-gray-100 rounded shadow w-full">
        <?php
        if (isset($_GET["meet"])) {
            $id = $_GET["meet"];
            $userid = $_SESSION['user']['id'];

            $sql = "SELECT *";
            $sql .= " FROM `meet`";
            $sql .= " WHERE `id`=$id";
            if($_SESSION['user']['type'] != 'sec') $sql .= " AND `userid`=$userid OR `clientid`=$userid";
        
            $result = $Bdd->query($sql);
        
            if ($Rdv = $result->fetch()) {
                $qcm = [];
                foreach (explode(";;", $Rdv->qcm) as $key => $value) {
                    print_r("val",$value);
                    array_push($qcm, [explode("::", $value)[0], explode("::", $value)[1]]);
                }

                print'<form method="post"><div class="form1 h-[40rem] flex justify-center flex-col px-96">';
                print'<h1 class="font-bold my-3">Compte rendu</h1>';
                    if (isset($msg)) {
                        print'<p class="text-green-500 mx-auto">'.$msg.'</p>';
                        unset($msg);
                    }  
                    print'<label for="resume">Résumé :</label>
                    <textarea class="rounded pl-1" name="resume" id="resume" value="';
                        print"".$Rdv->resume."";
                    print'">'.$Rdv->resume.'</textarea>';

                    for ($i=1; $i <= 3 ; $i++) {
                        print'<div class="my-3 flex flex-col"><label for="question-'.$i.'" class="font-semibold">Question n°'.$i.':</label>
                        <input'; if($_SESSION['user']['type'] == "usr") {print'disabled';} print' class="rounded pl-1" name="question-'.$i.'" id="question-'.$i.'" value="'.$qcm[$i-1][0].'"></input>';
                        print'<label for="reponse-'.$i.'">Réponse:</label>
                        <input'; if($_SESSION['user']['type'] == "usr") {print'disabled';} print' class="rounded pl-1" name="reponse-'.$i.'" id="reponse-'.$i.'" value="'.$qcm[$i-1][1].'"></input></div>';
                    }
                    if($_SESSION['user']['type'] != "usr") print'<button class="rounded bg-white w-52 mx-auto md:p-4 py-2 hover:bg-green-500 hover:text-black" type="submit" name="btnsave" id="btnsave" value="'.$Rdv->id.'">Publier</button>';
                print'</form></div>';
            } else {
                print'<p class="text-red">Veuillez sélectionner à nouveau le rendez-vous</p>';
            }
        } else {
            print'<p class="text-red">Veuillez sélectionner à nouveau le rendez-vous</p>';
        }
        ?>
    </div>
</div>