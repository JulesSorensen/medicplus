<header>
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
            >
            <li>
                <a class="md:p-4 py-2 block hover:text-gray-400" href="#"
                >Accueil</a
                >
            </li>
            <li>
                <a class="md:p-4 py-2 block hover:text-gray-400" href="#"
                >Planification</a
                >
            </li>
            <li>
                <a
                class="md:p-4 py-2 block hover:text-red-400 text-red-500"
                href="#"
                >Déconnexion</a
                >
            </li>
            </ul>
        </div>
    </nav>
</header>

<script>
    const button = document.querySelector('#menu-button');  
    const menu = document.querySelector('#menu');


    button.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });
</script>