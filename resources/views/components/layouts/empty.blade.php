<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/img/icon.png" type="image/x-icon">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased dark:bg-gray-850">
    <x-mary-nav sticky full-width>

        <x-slot:brand>


            {{-- Brand --}}
            <div>
                <h1 class="mx-auto max-w-4xl px-16 text-center text-xl font-semibold leading-tight sm:text-xl">
                    rbrasildev <span class="text-secondary">>_</span>
                </h1>
            </div>
        </x-slot:brand>
    </x-mary-nav>
    <x-mary-main full-width>
        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-mary-main>
</body>

</html>
