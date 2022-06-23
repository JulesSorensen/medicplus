<?php
if (!isset($_GET["month"])) {
  $month = date('n');
  $year = date('Y');
} else if (is_numeric($_GET["month"] > 12) || $_GET["month"] > 12 || $_GET["month"] < 1) {
  $month = date('n');
  $year = date('Y');
} else {
  $month = $_GET["month"];
  $year = date('Y');
}

if (!isset($_GET["year"])) {
  $year = date('Y');
} else if (is_numeric($_GET["year"] > 12)) {
  $year = date('Y');
} else {
  $year = $_GET["year"];
}

$number_of_days = cal_days_in_month(CAL_GREGORIAN,$month, $year);
$dates = [];

for ($x = 1; $x <= $number_of_days; $x++) {
    array_push($dates, date("F", strtotime($x . "-" . $month . "-" . $year)) . "-" . $x . "-" . $year . "-" . date("l", strtotime($x . "-" . $month . "-" . $year)));
}

$monthList = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
$monthIndex = $month - 1;

if (isset($_POST["cancel"])) {
  $id = $_POST["cancel"];
  $req = "DELETE FROM `meet` WHERE id = $id";
  $ORes = $Bdd->query($req);
  $Reu = $ORes->fetch();
  $message = "Le rendez-vous a bien été supprimé";
} else if (isset($_POST["edit"])) {
  $id = $_POST["edit"];
  header("Refresh:0; url=planif&edit=$id");
} else if (isset($_POST["validate"])) {
  $id = $_POST["validate"];
  $sql = "UPDATE `meet`";
  $sql .= " SET `validated` = true";
  $sql .= " WHERE id=$id";
  $ORes = $Bdd->query($sql);
  $valid = $ORes->fetch();
}


$id = $_SESSION['user']['id'];
if ($_SESSION["user"]['type'] == "sec") {
  $req = "SELECT * FROM `meet` order by date asc";  
} else {
  $req = "SELECT * FROM `meet` WHERE userId = $id order by date asc";
}
$ORes = $Bdd->query($req);
$meets = [];
if ($ORes) {
  while ($Reu = $ORes->fetch()) {
    if (isset($meets[explode(" ", $Reu->date)[0] ])) {
      array_push($meets[explode(" ", $Reu->date)[0]], $Reu);
    } else {
      $meets += [explode(" ", $Reu->date)[0] => [$Reu]];
    }
  }
}
$modalIds = [];

?>
<title>Accueil</title>
<div class="w-full flex justify-center"><p class="font-bold mt-3">CALENDRIER DES RENDEZ-VOUS</p></div>
<?php 
if (isset($message)) {
  print "<div class='w-full flex justify-center'><p class='text-green-500 mt-3'>$message</p></div>";
  isset($message);
}
?>
<div class="container mx-auto py-3">
  <div class="wrapper bg-white rounded shadow w-full ">
    <div class="header flex justify-between border-b p-2">
      <span class="text-lg font-bold">
        <?php echo "$monthList[$monthIndex] $year"; ?>
      </span>
      <div class="buttons">
        <button id="currentMonth" class="bg-gray-100 font-semibold p-1 rounded-lg hover:bg-gray-200">
          Current month
        </button>
        <button id="pmonth" class="p-1">
          <svg width="1em" fill="gray" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-left-circle"
            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
            <path fill-rule="evenodd"
              d="M8.354 11.354a.5.5 0 0 0 0-.708L5.707 8l2.647-2.646a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708 0z" />
            <path fill-rule="evenodd" d="M11.5 8a.5.5 0 0 0-.5-.5H6a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5z" />
          </svg>
        </button>
        <button id="nmonth" class="p-1">
          <svg width="1em" fill="gray" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right-circle"
            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
            <path fill-rule="evenodd"
              d="M7.646 11.354a.5.5 0 0 1 0-.708L10.293 8 7.646 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0z" />
            <path fill-rule="evenodd" d="M4.5 8a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5z" />
          </svg>
        </button>
      </div>
    </div>
    <table class="w-full">
      <thead>
        <tr>
          <th class="p-2 border-r h-10 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 xl:text-sm text-xs">
            <span class="xl:block lg:block md:block sm:block hidden">Lundi</span>
            <span class="xl:hidden lg:hidden md:hidden sm:hidden block">Lun</span>
          </th>
          <th class="p-2 border-r h-10 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 xl:text-sm text-xs">
            <span class="xl:block lg:block md:block sm:block hidden">Mardi</span>
            <span class="xl:hidden lg:hidden md:hidden sm:hidden block">Mar</span>
          </th>
          <th class="p-2 border-r h-10 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 xl:text-sm text-xs">
            <span class="xl:block lg:block md:block sm:block hidden">Mercredi</span>
            <span class="xl:hidden lg:hidden md:hidden sm:hidden block">Mer</span>
          </th>
          <th class="p-2 border-r h-10 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 xl:text-sm text-xs">
            <span class="xl:block lg:block md:block sm:block hidden">Jeudi</span>
            <span class="xl:hidden lg:hidden md:hidden sm:hidden block">Jeu</span>
          </th>
          <th class="p-2 border-r h-10 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 xl:text-sm text-xs">
            <span class="xl:block lg:block md:block sm:block hidden">Vendredi</span>
            <span class="xl:hidden lg:hidden md:hidden sm:hidden block">Ven</span>
          </th>
          <th class="p-2 border-r h-10 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 xl:text-sm text-xs">
            <span class="xl:block lg:block md:block sm:block hidden">Samedi</span>
            <span class="xl:hidden lg:hidden md:hidden sm:hidden block">Sa</span>
          </th>
          <th class="p-2 border-r h-10 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 xl:text-sm text-xs">
            <span class="xl:block lg:block md:block sm:block hidden">Dimanche</span>
            <span class="xl:hidden lg:hidden md:hidden sm:hidden block">Dim</span>
          </th>
        </tr>
      </thead>
      <tbody>
        <?php
          $go = FALSE;
          $enMonth = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
          $array = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
          $nb = 0;
          $maxLines = (explode("-", $dates[0])[3] == "Saturday" || explode("-", $dates[0])[3] == "Sunday") ? 6 : 5;
          for ($i=1; $i <= $maxLines; $i++) {
            ?> 
              <tr class="text-center h-20">
                <?php
            for ($j=1; $j <= 7; $j++) {
              if ($i == 1) {
                $dateExploded = explode("-", $dates[$nb]);
                $currentDate = $dateExploded[2] . "-" . ((array_search($dateExploded[0], $enMonth)+1) > 10 ? (array_search($dateExploded[0], $enMonth)+1) : "0" . (array_search($dateExploded[0], $enMonth)+1) . "-" . ($dateExploded[1] > 10 ? $dateExploded[1] : "0" .$dateExploded[1]));
                $d = explode("-", $dates[$nb])[3];
                if ($d == $array[$j-1]) {
                  $go = TRUE;
                  ?>
                    <td
                      class="border p-1 h-40 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 overflow-y-auto transition cursor-pointer duration-500 ease hover:bg-gray-300">
                      <div class="flex flex-col h-40 mx-auto xl:w-40 lg:w-30 md:w-30 sm:w-full w-10 mx-auto">
                        <div class="top h-5 w-full">
                          <span class="text-gray-500"><?php echo $nb+1; ?></span>
                        </div>
                        <?php
                          if (isset($meets[$currentDate])) {
                            ?>
                              <div class="bottom flex-grow h-30 py-1 w-full cursor-pointer">
                                <?php 
                                  foreach ($meets[$currentDate] as $key => $value) {
                                    $name = $value->clientName;
                                    $id = $value->id;
                                    $hour = substr(explode(" ", $value->date)[1], 0, -3);
                                    $uniqueId = sha1($value->id.$name);
                                    array_push($modalIds, $uniqueId);
                                    print "<div id='$uniqueId' class='event select-none w-full"; if ($value->validated) {print" bg-green-500 ";} else {print" bg-gray-400 ";} print"text-white rounded p-1 text-sm mb-1'>
                                      <span class='event-name'>
                                        $name
                                      </span>
                                      <span class='time'>
                                        $hour
                                      </span>
                                    </div>";
                                    print "<div id='modal-$uniqueId' style=' background-color: rgba(0, 0, 0, 0.8)' class='fixed invisible z-40 top-0 right-0 left-0 bottom-0 h-full w-full' x-show.transition.opacity='openEventModal'>
                                      <div class='p-4 max-w-xl mx-auto relative absolute left-0 right-0 overflow-hidden mt-24'>
                                        <div id='close-$uniqueId' class='shadow absolute right-0 top-0 w-10 h-10 rounded-full bg-white text-gray-500 hover:text-gray-800 inline-flex items-center justify-center cursor-pointer'
                                          x-on:click='openEventModal = !openEventModal'>
                                          <svg class='fill-current w-6 h-6' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'>
                                            <path
                                              d='M16.192 6.344L11.949 10.586 7.707 6.344 6.293 7.758 10.535 12 6.293 16.242 7.707 17.656 11.949 13.414 16.192 17.656 17.606 16.242 13.364 12 17.606 7.758z' />
                                          </svg>
                                        </div>
                                        <div class='shadow w-full rounded-lg bg-white overflow-hidden w-full block p-8'>
                                          
                                          <h2 class='font-bold text-2xl mb-6 text-gray-800 border-b pb-2'>Rendez-vous de $name</h2>
                                          <div class='mb-4'>
                                            <p class='text-gray-800 block mb-1 font-bold text-sm tracking-wide'>Email: $value->clientMail</p>
                                          </div>
                                          <div class='mb-4'>
                                            <p class='text-gray-800 block mb-1 font-bold text-sm tracking-wide'>Date: $value->date</p>
                                          </div>
                                          <div class='mb-4'>
                                            <p class='text-gray-800 block mb-1 font-bold text-sm tracking-wide'>Lieu: $value->place</p>
                                          </div>
                                          <div class='mb-4'>
                                            <p class='text-gray-800 block mb-1 font-bold text-sm tracking-wide'>Résumé: $value->resume</p>
                                          </div>
                                          <div class='mt-8 text-right'>
                                            <form method='POST'>
                                              <button name='cancel' value='$id' type='submit' class='bg-white hover:bg-red-100 text-red-700 font-semibold py-2 px-4 border border-red-300 rounded-lg shadow-sm mr-2' @click='openEventModal = !openEventModal'>
                                                Supprimer
                                              </button>";
                                              if ($value->validated == false) {	
                                                print"<button name='edit' value='$id' type='submit' class='bg-white hover:bg-gray-100 text-gray-700 font-semibold py-2 px-4 border border-gray-300 rounded-lg shadow-sm mr-2' @click='openEventModal = !openEventModal'>
                                                  Editer
                                                </button>";
                                              }
                                              if ($_SESSION['user']['type'] == 'sec' && $value->validated == false) {
                                                print"<button name='validate' value='$id' type='submit' class='bg-green-800 hover:bg-gray-700 text-white font-semibold py-2 px-4 border border-gray-700 rounded-lg shadow-sm mr-2' @click='addEvent()'>
                                                  Valider
                                                </button>";
                                              }
                                              if ($_SESSION['user']['type'] != 'usr') {
                                                print"<button name='open' value='$id' type='submit' class='bg-gray-800 hover:bg-gray-700 text-white font-semibold py-2 px-4 border border-gray-700 rounded-lg shadow-sm' @click='addEvent()'>
                                                  Ouvrir
                                                </button>";
                                              }
                                            print"</form>
                                          </div>
                                        </div>
                                      </div>
                                    </div>";
                                  }
                                ?>
                                
                              </div>
                            <?php
                          }
                        ?>
                        <div class="bottom flex-grow h-30 py-1 w-full cursor-pointer"></div>
                      </div>
                    </td>
                  <?php
                } else {
                  ?>
                    <td
                      class="border bg-gray-100 p-1 h-40 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 overflow-y-auto transition cursor-pointer duration-500 ease hover:bg-gray-300">
                      <div class="flex flex-col h-40 mx-auto xl:w-40 lg:w-30 md:w-30 sm:w-full w-10 mx-auto">
                        <div class="top h-5 w-full">
                          <span class="text-gray-500 text-sm"></span>
                        </div>
                        <div class="bottom flex-grow h-30 py-1 w-full cursor-pointer"></div>
                      </div>
                    </td>
                  <?php
                }
              } else {
                if (array_key_exists($nb, $dates)) {
                  $dateExploded = explode("-", $dates[$nb]);
                  $currentDate = $dateExploded[2] . "-" . ((array_search($dateExploded[0], $enMonth)+1) > 10 ? (array_search($dateExploded[0], $enMonth)+1) : "0" . (array_search($dateExploded[0], $enMonth)+1) . "-" . ($dateExploded[1] > 10 ? $dateExploded[1] : "0" .$dateExploded[1]));
                  $d = explode("-", $dates[$nb])[3];
                  ?>
                    <td
                      class="border p-1 h-40 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 overflow-auto transition cursor-pointer duration-500 ease hover:bg-gray-300">
                      <div class="flex flex-col h-40 mx-auto xl:w-40 lg:w-30 md:w-30 sm:w-full w-10 mx-auto">
                        <div class="top h-5 w-full">
                          <span class="text-gray-500"><?php echo $nb+1; ?></span>
                        </div>
                        <?php
                          if (isset($meets[$currentDate])) {
                            ?>
                              <div class="bottom flex-grow h-30 py-1 w-full cursor-pointer">
                                <?php 
                                  foreach ($meets[$currentDate] as $key => $value) {
                                    $name = $value->clientName;
                                    $id = $value->id;
                                    $hour = substr(explode(" ", $value->date)[1], 0, -3);
                                    $uniqueId = sha1($value->id.$name);
                                    array_push($modalIds, $uniqueId);
                                    print "<div id='$uniqueId' class='event select-none w-full"; if ($value->validated) {print" bg-green-500 ";} else {print" bg-gray-400 ";} print"text-white rounded p-1 text-sm mb-1'>
                                      <span class='event-name'>
                                        $name
                                      </span>
                                      <span class='time'>
                                        $hour
                                      </span>
                                    </div>";
                                    print "<div id='modal-$uniqueId' style=' background-color: rgba(0, 0, 0, 0.8)' class='fixed invisible z-40 top-0 right-0 left-0 bottom-0 h-full w-full' x-show.transition.opacity='openEventModal'>
                                      <div class='p-4 max-w-xl mx-auto relative absolute left-0 right-0 overflow-hidden mt-24'>
                                        <div id='close-$uniqueId' class='shadow absolute right-0 top-0 w-10 h-10 rounded-full bg-white hover:text-gray-800 inline-flex items-center justify-center cursor-pointer'
                                          x-on:click='openEventModal = !openEventModal'>
                                          <svg class='fill-current w-6 h-6' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'>
                                            <path
                                              d='M16.192 6.344L11.949 10.586 7.707 6.344 6.293 7.758 10.535 12 6.293 16.242 7.707 17.656 11.949 13.414 16.192 17.656 17.606 16.242 13.364 12 17.606 7.758z' />
                                          </svg>
                                        </div>
                                        <div class='shadow w-full rounded-lg bg-white overflow-hidden w-full block p-8'>
                                          
                                          <h2 class='font-bold text-2xl mb-6 text-gray-800 border-b pb-2'>Rendez-vous de $name</h2>
                                          <div class='mb-4'>
                                            <p class='text-gray-800 block mb-1 font-bold text-sm tracking-wide'>Email: $value->clientMail</p>
                                          </div>
                                          <div class='mb-4'>
                                            <p class='text-gray-800 block mb-1 font-bold text-sm tracking-wide'>Date: $value->date</p>
                                          </div>
                                          <div class='mb-4'>
                                            <p class='text-gray-800 block mb-1 font-bold text-sm tracking-wide'>Lieu: $value->place</p>
                                          </div>
                                          <div class='mb-4'>
                                            <p class='text-gray-800 block mb-1 font-bold text-sm tracking-wide'>Résumé: $value->resume</p>
                                          </div>
                                          <div class='mt-8 text-right'>
                                            <form method='POST'>
                                              <button name='cancel' value='$id' type='submit' class='bg-white hover:bg-red-100 text-red-700 font-semibold py-2 px-4 border border-red-300 rounded-lg shadow-sm mr-2' @click='openEventModal = !openEventModal'>
                                                Supprimer
                                              </button>";
                                              if ($value->validated == false) {	
                                                print"<button name='edit' value='$id' type='submit' class='bg-white hover:bg-gray-100 text-gray-700 font-semibold py-2 px-4 border border-gray-300 rounded-lg shadow-sm mr-2' @click='openEventModal = !openEventModal'>
                                                Editer
                                              </button>";
                                              }
                                              if ($_SESSION['user']['type'] == 'sec' && $value->validated == false) {
                                                print"<button name='validate' value='$id' type='submit' class='bg-green-800 hover:bg-gray-700 text-white font-semibold py-2 px-4 border border-gray-700 rounded-lg shadow-sm mr-2' @click='addEvent()'>
                                                  Valider
                                                </button>";
                                              }
                                              if ($_SESSION['user']['type'] != 'usr') {
                                                print"<button name='open' value='$id' type='submit' class='bg-gray-800 hover:bg-gray-700 text-white font-semibold py-2 px-4 border border-gray-700 rounded-lg shadow-sm' @click='addEvent()'>
                                                  Ouvrir
                                                </button>";
                                              }
                                            print"</form>
                                          </div>
                                        </div>
                                      </div>
                                    </div>";
                                  }
                                ?>
                                
                              </div>
                            <?php
                          }
                        ?>
                        <div class="bottom flex-grow h-30 py-1 w-full cursor-pointer"></div>
                      </div>
                    </td>
                  <?php
                } else {
                  ?>
                    <td
                      class="border bg-gray-100 p-1 h-40 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 overflow-auto transition cursor-pointer duration-500 ease hover:bg-gray-300">
                      <div class="flex flex-col h-40 mx-auto xl:w-40 lg:w-30 md:w-30 sm:w-full w-10 mx-auto">
                        <div class="top h-5 w-full">
                          <span class="text-gray-500 text-sm"></span>
                        </div>
                        <div class="bottom flex-grow h-30 py-1 w-full cursor-pointer"></div>
                      </div>
                    </td>
                  <?php
                }
              }
              if ($go) {
                $nb += 1;
              }
            }
            ?>
              </tr>
            <?php
          }
        ?>
      </tbody>
    </table>
  </div>
</div>

<script>
  <?php echo "let currentMonth = $month;\nlet currentYear = $year;\n" ?>
  $("#currentMonth").click(() => {
    document.location = `home`;
  });
  
  $("#pmonth").click(() => {
    if ((currentMonth-1) < 1) {
      document.location = `home&year=${currentYear-1}&month=12`;
    } else {
      document.location = `home&year=${currentYear}&month=${currentMonth-1}`;
    }
  });

  $("#nmonth").click(() => {
    if ((currentMonth+1) > 12) {
      document.location = `home&year=${currentYear+1}&month=1`;
    } else {
      document.location = `home&year=${currentYear}&month=${currentMonth+1}`;
    }
  });

  <?php
  foreach ($modalIds as $key => $value) {
    print "
    $('#$value').click(() => {
      document.getElementById('modal-$value').classList.remove('invisible');
      document.getElementById('modal-$value').classList.add('visible');
    });
    
    $('#close-$value').click(() => {
      document.getElementById('modal-$value').classList.add('invisible');
      document.getElementById('modal-$value').classList.remove('visible');
    });
    ";
  }
  ?>
</script>