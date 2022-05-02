<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="icon" href="images/photoplus.ico"> -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-200">
    <?php
    session_start();
    // session_destroy();
    // error_reporting(E_ERROR | E_PARSE);

    if (isset($_SESSION["online"])) {
        if(isset($_GET['p'])) {
            $page = $_GET['p'] . ".php";
            switch ($_GET['p']) {
                case 'home':
                    include("header.php");
                    include("pages/$page"); break;
                default:
                    $_GET['p'] = "login";
                    include("pages/login.php");
                    break;
            }
        }
    } else {
        $_GET['p'] = "login";
        include("pages/login.php");
    }
    ?>
</body>

</html>