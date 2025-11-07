<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ empty($title) ? 'appGastos.' : ($title . ' | appGastos.') }}</title>

        <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo-light.png') }}" />

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

        <script defer src="https://unpkg.com/alpinejs-notify@latest/dist/notifications.min.js"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        {{-- @fluxAppearance --}}
    </head>

    <body class="min-h-screen bg-white dark:bg-zinc-900">
        <div class="flex min-h-screen">
            <div class="flex-1 flex justify-center items-center relative">
                {{ $slot }}
            </div>
            <div class="flex-1 p-4 max-lg:hidden">
                <div
                    class="text-zinc-900 relative rounded-lg h-full w-full bg-zinc-900 flex flex-col items-start justify-end p-16"
                    style="background-image: url({{ asset('assets/img/fondo.jpg') }}); background-size: cover"
                >
                    <div class="flex gap-2 mb-4">
                        <flux:icon.star variant="solid" />
                        <flux:icon.star variant="solid" />
                        <flux:icon.star variant="solid" />
                        <flux:icon.star variant="solid" />
                        <flux:icon.star variant="solid" />
                    </div>
                    <div class="mb-6 italic font-base text-3xl xl:text-4xl">
                        <p class="text-2xl xl:text-3xl font-bold" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                            Sistema de Gestión de Gastos Familiares
                        </p>
                    </div>
                </div>
            </div>
        </div>

        @persist('toast')
            <x-notificacion />
        @endpersist

        @fluxScripts
    </body>
</html>
