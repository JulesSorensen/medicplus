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
?>

<div class="container mx-auto mt-10">
  <div class="wrapper bg-white rounded shadow w-full ">
    <div class="header flex justify-between border-b p-2">
      <span class="text-lg font-bold">
        <?php echo "$monthList[$monthIndex] $year"; ?>
      </span>
      <div class="buttons">
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
          $array = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
          $nb = 0;
          $maxLines = (explode("-", $dates[0])[3] == "Saturday" || explode("-", $dates[0])[3] == "Sunday") ? 6 : 5;
          for ($i=1; $i <= $maxLines; $i++) {
            ?> 
              <tr class="text-center h-20">
            <?php
            for ($j=1; $j <= 7; $j++) {
              if ($i == 1) {
                $d = explode("-", $dates[$nb])[3];
                if ($d == $array[$j-1]) {
                  $go = TRUE;
                  ?>
                    <td
                      class="border p-1 h-40 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 overflow-auto transition cursor-pointer duration-500 ease hover:bg-gray-300">
                      <div class="flex flex-col h-40 mx-auto xl:w-40 lg:w-30 md:w-30 sm:w-full w-10 mx-auto">
                        <div class="top h-5 w-full">
                          <span class="text-gray-500"><?php echo $nb+1; ?></span>
                        </div>
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
              } else {
                if (array_key_exists($nb, $dates)) {
                  ?>
                    <td
                      class="border p-1 h-40 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 overflow-auto transition cursor-pointer duration-500 ease hover:bg-gray-300">
                      <div class="flex flex-col h-40 mx-auto xl:w-40 lg:w-30 md:w-30 sm:w-full w-10 mx-auto">
                        <div class="top h-5 w-full">
                          <span class="text-gray-500"><?php echo $nb+1; ?></span>
                        </div>
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
          <!-- <td
            class="border p-1 h-40 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 overflow-auto transition cursor-pointer duration-500 ease hover:bg-gray-300 ">
            <div class="flex flex-col h-40 mx-auto xl:w-40 lg:w-30 md:w-30 sm:w-full w-10 mx-auto">
              <div class="top h-5 w-full">
                <span class="text-gray-500">1</span>
              </div>
              <div class="bottom flex-grow h-30 py-1 w-full cursor-pointer">
                <div class="event bg-purple-400 text-white rounded p-1 text-sm mb-1">
                  <span class="event-name">
                    Meeting
                  </span>
                  <span class="time">
                    12:00~14:00
                  </span>
                </div>
                <div class="event bg-purple-400 text-white rounded p-1 text-sm mb-1">
                  <span class="event-name">
                    Meeting
                  </span>
                  <span class="time">
                    18:00~20:00
                  </span>
                </div>
              </div>
            </div>
          </td> -->
      </tbody>
    </table>
  </div>
</div>

<script>
  <?php echo "var currentMonth = $month;\nvar currentYear = $year;\n" ?>
  
  $("#pmonth").click(() => {
    if ((currentMonth-1) < 1) {
      document.location = `index.php?p=home&year=${currentYear-1}&month=12`;
    } else {
      document.location = `index.php?p=home&year=${currentYear}&month=${currentMonth-1}`;
    }
  });

  $("#nmonth").click(() => {
    if ((currentMonth+1) > 12) {
      document.location = `index.php?p=home&year=${currentYear+1}&month=1`;
    } else {
      document.location = `index.php?p=home&year=${currentYear}&month=${currentMonth+1}`;
    }
  });
</script>