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
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky collapsible class="bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
            <flux:sidebar.header>
                <flux:sidebar.brand
                    href="#"
                    logo="{{ asset('assets/img/logo-light.png') }}"
                    logo:dark="{{ asset('assets/img/logo-dark.png') }}"
                    name="appGastos."
                />
                <flux:sidebar.collapse class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2" />
            </flux:sidebar.header>
            <flux:sidebar.nav>
                <flux:sidebar.item
                    icon="layout-panel-left"
                    :href="route('inicio.index')"
                    :current="request()->routeIs('inicio.*')"
                    wire:navigate
                >
                    Inicio
                </flux:sidebar.item>
                <flux:sidebar.item
                    icon="wallet-cards"
                    {{-- :href="route('inicio.index')" --}}
                    {{-- :current="request()->routeIs('inicio.*')" --}}
                    wire:navigate
                >
                    Control de Gastos
                </flux:sidebar.item>
                <flux:sidebar.item
                    icon="box"
                    {{-- :href="route('inicio.index')" --}}
                    {{-- :current="request()->routeIs('inicio.*')" --}}
                    wire:navigate
                >
                    Mantenedores
                </flux:sidebar.item>
                {{-- <flux:sidebar.group expandable icon="star" heading="Favorites" class="grid">
                    <flux:sidebar.item href="#">Marketing site</flux:sidebar.item>
                    <flux:sidebar.item href="#">Android app</flux:sidebar.item>
                    <flux:sidebar.item href="#">Brand guidelines</flux:sidebar.item>
                </flux:sidebar.group> --}}
            </flux:sidebar.nav>
            <flux:sidebar.spacer />
            <flux:dropdown position="top" align="start" class="max-lg:hidden">
                <flux:sidebar.profile name="Olivia Martin" avatar:color="auto"/>
                <flux:menu>
                    <flux:menu.item icon="user-round">Mi perfil</flux:menu.item>
                    <flux:menu.separator />
                    <flux:menu.item icon="log-out">Cerrar sesión</flux:menu.item>
                </flux:menu>
            </flux:dropdown>
            </flux:sidebar>

        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
            <flux:spacer />
            <flux:dropdown position="top" align="start">
                <flux:profile initials="OM" avatar:color="auto" />
                <flux:menu>
                    <flux:menu.item icon="user-round">Mi perfil</flux:menu.item>
                    <flux:menu.separator />
                    <flux:menu.item icon="log-out">Cerrar sesión</flux:menu.item>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        <flux:main class="p-6!">
            {{ $slot }}
        </flux:main>

        @persist('toast')
            <x-notificacion />
        @endpersist

        @fluxScripts
    </body>
</html>
