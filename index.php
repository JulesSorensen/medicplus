<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/medicplus.ico">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./tailwind.css"></script>
</head>

<body>
    <div id="app" class="bg-gray-200 h-full w-full">
        <?php
        include("db/Bdd.php");
        session_start();
        // error_reporting(E_ERROR | E_PARSE);

        if (isset($_SESSION["online"])) {
            if(isset($_GET['p'])) {
                include("header.php");
                switch ($_GET['p']) {
                    case "report":
                        include("pages/report.php"); break;
                    case "planif":
                        include("pages/planif.php"); break;
                    case "signup":
                        include("pages/signup.php"); break;
                    default:
                        include("pages/home.php"); break;
                }
            }
        } else {

            switch ($_GET['p']) {

                case "signup":
                    $_GET['p'] = "signup";
                    include("pages/signup.php"); break;

                default:
                    $_GET['p'] = "login";
                    include("pages/login.php"); break;
                }
        }
        ?>
    </div>
    
    <script>
        if ( window.history.replaceState ) { // don't resend forms on reload/back
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
</body>

</html>