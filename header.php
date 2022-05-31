<?php
print '<header>
    <nav
    class="
        flex flex-wrap
        items-center
        justify-between
        w-full
        py-4
        md:py-0
        px-4
        text-lg text-gray-700
        bg-white
    "
    >
        <div class="flex flex-row items-center space-x-3">
            <a href="#">
                <img class="h-[32.125px]" src="images/medicplus.png" alt="MEDIC+">
            </a>
            <h1 class="font-bold">Medic+</h1>
        </div>
        
            <svg
            xmlns="http://www.w3.org/2000/svg"
            id="menu-button"
            class="h-6 w-6 cursor-pointer md:hidden block"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"
            />
            </svg>
        
        <div class="hidden w-full md:flex md:items-center md:w-auto" id="menu">
            <ul
            class="
                pt-4
                text-base text-gray-700
                md:flex
                md:justify-between 
                md:pt-0"
            >';
            if(isset($_SESSION["online"])){
            print'<li>
                <a class="md:p-4 py-2 block hover:text-gray-400" href="?p=home"
                >Accueil</a
                >
            </li>';
            }
            if(isset($_SESSION["online"]) && isset($_SESSION["user"]["type"]) == "sec"){
                print'<li>
                    <form method="POST">
                    <button type="submit" name="deco" id="deco"><a class="md:p-4 py-2 block hover:text-gray-400" href="?p=planif"
                    >Planification</a
                    ></button>
                    </form>
                </li>';
            }
            if(isset($_SESSION["online"])){
                print'<li>
                    <form method="POST">
                    <button type="submit" name="deco" id="deco"><a 
                    class="md:p-4 py-2 block hover:text-red-400 text-red-500"
                    >Déconnexion</a
                    ></button>
                    </form>
                </li>';
                if(isset($_POST['deco'])){
                    session_destroy();
                    header('refresh:0');
                }
            }
            
            print'</ul>
        </div>
    </nav>
</header>';
?>


<script>
    const button = document.querySelector('#menu-button');  
    const menu = document.querySelector('#menu');


    button.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });
</script>
