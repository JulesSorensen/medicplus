<?php

    $bdUser = "root";
    $bdPasswd = "";
    $dbname="medicplus";
    $host = "localhost";

    try{
        $Bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$bdUser,$bdPasswd);
        $Bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }
    catch (PDOException $e)
    {
        echo "IMPOSSIBLE DE SE CONNECTER";
    }