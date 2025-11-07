<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new
#[Layout('layouts::auth')]
#[Title('Login')]
class extends Component
{
    //
};
?>

<div class="w-80 max-w-80 space-y-6">
    <div class="flex justify-center opacity-75 dark:opacity-90">
        <a
            href="{{ route('inicio.index') }}"
            wire:navigate
            class="group flex items-center gap-2"
        >
            <img src="{{ asset('assets/img/logo-light.png') }}" alt="Logo" class="size-22 dark:hidden" />
            <img src="{{ asset('assets/img/logo-dark.png') }}" alt="Logo" class="size-22 hidden dark:block" />
        </a>
    </div>
    <flux:heading class="text-center" size="xl">
        Bienvenido de nuevo
    </flux:heading>
    <form class="flex flex-col gap-6" wire:submit="login">
        <div class="flex flex-col gap-4">
            <flux:field>
                <flux:label>Usuario</flux:label>
                <flux:input wire:model="usuario" placeholder="Ingrese su usuario" />
                <flux:error name="usuario" class="mt-0! text-xs!" />
            </flux:field>
            <flux:field>
                <flux:label>Contraseña</flux:label>
                <flux:input type="password" wire:model="contrasena" placeholder="Ingrese su contraseña" type="password" viewable />
                <flux:error name="contrasena" class="mt-0! text-xs!" />
            </flux:field>
        </div>
        <flux:checkbox label="Recordarme" wire:model="recordarme" />
        <flux:button type="submit" variant="primary" class="w-full cursor-pointer">
            Iniciar sesión
        </flux:button>
    </form>
</div>

