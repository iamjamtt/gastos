<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

new class extends Component
{
    public function cerrarSesion()
    {
        Auth::logout();

        return $this->redirect(route('login'), navigate: true);
    }
};
?>

<flux:menu.item icon="log-out" wire:click="cerrarSesion">Cerrar sesión</flux:menu.item>
