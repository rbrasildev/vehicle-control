<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    @vite('resources/css/app.css')
    <title>{{ config('app.name', 'Laravel') }}</title>
    @livewireStyles
    
</head>

<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside
            class="bg-gray-800 text-white md:w-64 py-4 px-2 fixed left-0 md:fixed md:top-0 md:left-0 md:bottom-0 w-full top-0 flex md:block gap-2 justify-between items-center">
            <h1 class="text-md md:text-2xl font-semibold text-center">Dashboard</h1>
            <i onclick="toggle()" class='bx bx-menu cursor-pointer z-10 text-3xl sm:hidden'></i>
            <nav
                class="fixed hidden transition-transform transform duration-500 translate-x-full md:translate-x-0 md:relative bg-gray-800 px-4 md:flex mt-16 bottom-0 right-0 top-0 md:mt-16 gap-2 md:flex-col">
                <a href="/" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                    <li class="bx bx-home"></li>
                    <span class="">Dashboard</span>
                </a>
                <a href="/profile" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700"
                    wire:navigate>
                    <li class="bx bx-user"></li>
                    <span @class(['font-bold' => request()->is('/profile')])>Usuários</span>
                </a>
                <a href="/veiculos" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700"
                    wire:navigate>
                    <li class="bx bx-car"></li>
                    <span @class(['text-green-500' => request()->is('/veiculos')])>Veículos</span>
                </a>
                <a href="/profile" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                    <li class="bx bx-user"></li>
                    <span>ONU</span>
                </a>
                <a href="/profile" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                    <li class="bx bx-user"></li>
                    <span>CTO</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="md:ml-64 mt-16 md:mt-0 md:w-full flex-grow p-6">
            <main class="mt-4">
                {{ $slot }}
            </main>
        </div>
    </div>

    @livewireScripts
    <script>
        const menu = document.querySelector('.bx-menu');
        menu.addEventListener('click', () => {
            const nav = document.querySelector('nav');
            nav.classList.toggle('hidden'); // Ocultar/mostrar
            nav.classList.toggle('translate-x-full'); // Aplicar transição
        });
    </script>
</body>

</html>
