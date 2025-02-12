<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <title>{{ config('app.name', 'SGPOS') }}</title>
    @livewireStyles

</head>

<body class="font-sans antialiased">
    <x-mary-nav sticky full-width>

        <x-slot:brand>
            <label for="main-drawer" class="lg:hidden mr-3">
                <x-mary-icon name="o-bars-3" class="cursor-pointer" />
            </label>

            <div>SGP OS</div>
        </x-slot:brand>

        <x-slot:actions>
            <livewire:sgpcity />
            <x-mary-theme-toggle />
        </x-slot:actions>
    </x-mary-nav>

    <x-mary-main with-nav full-width>
        <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-200">

            @if ($user = auth()->user())
                <x-mary-list-item :item="$user" value="name" sub-value="email" no-separator no-hover
                    class="pt-2">
                    <x-slot:actions>
                        <x-mary-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="logoff"
                            no-wire-navigate link="/logout" />
                    </x-slot:actions>
                </x-mary-list-item>
            @endif

            <x-mary-menu activate-by-route>
                <x-mary-menu-item title="Home" icon="o-home" link="/dashboard" />
                <x-mary-menu-item title="Ordens de Serviço" icon="s-wrench-screwdriver" link="/servico" />
                <x-mary-menu-item title="Recolher" icon="s-arrow-uturn-left" link="/recolher" />
                <x-mary-menu-item title="Onu" icon="m-device-tablet" link="/fttx/onu" />
                <x-mary-menu-item title="Wifi" icon="o-wifi" link="/wifi" />
                <x-mary-menu-item title="Veículos" icon="o-archive-box" link="/veiculos" />
                <x-mary-menu-sub title="Usuários" icon="o-users">
                    <x-mary-menu-item title="Perfil" icon="o-sparkles" link="/profile" />
                    <x-mary-menu-item title="Users" icon="o-users" link="/users" />
                </x-mary-menu-sub>
            </x-mary-menu>

        </x-slot:sidebar>
        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-mary-main>

    <x-mary-toast />

</body>

@livewireScripts


</html>
