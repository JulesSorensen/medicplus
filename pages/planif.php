<?php
$postTab = [];
print '<form action="post">
    <div class="form1">
        <label for="name">Nom / Prénom :</label>
        <input name="name" id="name" type="text">';

        print'<label for="email">Addresse Mail :</label>
        <input name="email" id="email" type="mail">';

        print'<label for="date">Date :</label>
        <input name="date" id="date" type="date">';

        print'<label for="lieu">Lieu :</label>
        <input name="lieu" id="lieu" type="text">';

        print'<label for="resume">Résumé :</label>
        <textarea name="resume" id="resume"></textarea>';

    print'</div>
</form>';

if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['date']) && isset($_POST['lieu']) && isset($_POST['resume'])){

}

?>

