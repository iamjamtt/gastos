<?php

use App\Models\ControlMensual;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

new
#[Layout('layouts::app')]
#[Title('Control de Gastos')]
class extends Component
{
    use WithPagination;

    #[Url(except: '')]
    public string $buscar = '';

    #[Url(except: 10)]
    public int $mostrar = 10;

    #[Computed()]
    public function controles()
    {
        $data = ControlMensual::query()
            ->when($this->buscar, function ($query) {
                $query->search($this->buscar);
            })
            ->orderBy('id_control', 'desc')
            ->paginate($this->mostrar);

        return $data;
    }
};
?>

<div>
    <x-head>
        <x-slot name="breadcrumbs">
            <flux:breadcrumbs>
                <flux:breadcrumbs.item href="{{ route('inicio.index') }}" wire:navigate>Inicio</flux:breadcrumbs.item>
                <flux:breadcrumbs.item>Control</flux:breadcrumbs.item>
            </flux:breadcrumbs>
        </x-slot>
    </x-head>
    <x-main>
        <div class="grid grid-cols-1 gap-3">
            <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-2">
                <div class="flex items-center gap-2">
                    <flux:icon name="table" class="text-zinc-700 dark:text-zinc-200" />
                    <span class="text-md font-semibold text-zinc-700 dark:text-zinc-200">Control de Gastos</span>
                    <span class="text-md text-zinc-500 dark:text-zinc-400">({{ $this->controles->count() }} {{ $this->controles->count() === 1 ? 'registro' : 'registros' }})</span>
                </div>
                <flux:button icon="square-pen" variant="primary" size="sm">
                    Nuevo
                </flux:button>
            </div>
            <x-card class="gap-0!">
                <div class="px-3 py-2 mb-0 bg-zinc-100 text-sm text-zinc-700 dark:bg-zinc-950 dark:text-zinc-100">
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                        <div class="flex items-center">
                            <span class="text-zinc-700 dark:text-zinc-200 mr-2">Mostrar</span>
                            <flux:select wire:model.live.debounce.500ms="mostrar" size="sm">
                                <flux:select.option value="5">5</flux:select.option>
                                <flux:select.option value="10">10</flux:select.option>
                                <flux:select.option value="25">25</flux:select.option>
                                <flux:select.option value="50">50</flux:select.option>
                                <flux:select.option value="100">100</flux:select.option>
                            </flux:select>
                            <span class="text-zinc-700 dark:text-zinc-200 ml-2">entradas</span>
                        </div>
                        <div class="flex items-center md:w-200px">
                            <flux:input
                                type="text"
                                icon="search"
                                placeholder="Buscar..."
                                wire:model.live.debounce.500ms="buscar"
                                size="sm"
                            >
                                <x-slot name="iconTrailing">
                                    <flux:button
                                        size="sm"
                                        variant="subtle"
                                        icon="x-mark"
                                        class="-mr-1 cursor-pointer"
                                        wire:click="$js.limpiarBuscar"
                                    />
                                </x-slot>
                            </flux:input>
                        </div>
                    </div>
                </div>
                <div class="relative overflow-hidden w-full overflow-x-auto border-t border-zinc-200 dark:border-zinc-800">
                    <table class="w-full text-left text-sm text-zinc-800 dark:text-zinc-200">
                        <thead class="border-b border-zinc-200 bg-zinc-100 text-sm text-zinc-700 dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-100">
                            <tr>
                                <th scope="col" class="px-3 py-2 text-center w-[70px]">NRO</th>
                                <th scope="col" class="px-3 py-2 border-l border-zinc-200 dark:border-zinc-800 w-[300px]">TITULO</th>
                                <th scope="col" class="px-3 py-2 border-l border-zinc-200 dark:border-zinc-800 text-center w-[200px]">AÑO</th>
                                <th scope="col" class="px-3 py-2 border-l border-zinc-200 dark:border-zinc-800 text-center w-[200px]">MES</th>
                                <th scope="col" class="px-3 py-2 border-l border-zinc-200 dark:border-zinc-800 text-center w-[200px]">ESTADO</th>
                                <th scope="col" class="px-3 py-2 border-l border-zinc-200 dark:border-zinc-800 w-[70px]"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700 dark:bg-zinc-900">
                            @forelse ($this->controles as $control)
                                {{-- <tr wire:key="{{ $rol->id_rol }}">
                                    <td class="px-3 py-2 text-center">
                                        @php
                                            $numero = $loop->iteration + (($this->controles->currentPage() - 1) * $this->controles->perPage());
                                        @endphp
                                        {{ str_pad($numero, 2, '0', STR_PAD_LEFT) }}
                                    </td>
                                    <td class="px-3 py-2 border-l border-zinc-200 dark:border-zinc-800">
                                        {{ $rol->nombre_rol }}
                                    </td>
                                    <td class="px-3 py-2 border-l border-zinc-200 dark:border-zinc-800">
                                        {{ $rol->descripcion_rol ? Str::limit($rol->descripcion_rol, 50, '…') : '...' }}
                                    </td>
                                    <td class="px-3 py-2 border-l border-zinc-200 dark:border-zinc-800 text-center">
                                        <flux:modal.trigger name="estado-{{ $rol->id_rol }}">
                                            <flux:badge
                                                as="button"
                                                icon="{{ $rol->estado_rol->getIcon() }}"
                                                color="{{ $rol->estado_rol->getColor() }}"
                                                class="cursor-pointer transition duration-500 ease-in-out"
                                            >
                                                {{ $rol->estado_rol->value() }}
                                            </flux:badge>
                                        </flux:modal.trigger>
                                        <!-- Modal cambiar estado -->
                                        <flux:modal
                                            name="estado-{{ $rol->id_rol }}"
                                            class="min-w-[18rem] dark:bg-zinc-950 border dark:border-zinc-800 !text-left"
                                        >
                                            <div class="space-y-6">
                                                <div>
                                                    <flux:heading size="lg">
                                                        Estado del rol
                                                    </flux:heading>

                                                    <flux:subheading>
                                                        <p>
                                                            ¿Está seguro de que desea cambiar el estado del rol "{{ $rol->nombre_rol }}"?
                                                        </p>
                                                    </flux:subheading>
                                                </div>

                                                <div class="flex gap-2">
                                                    <flux:spacer />

                                                    <flux:modal.close>
                                                        <flux:button variant="ghost" class="cursor-pointer">Cancelar</flux:button>
                                                    </flux:modal.close>

                                                    <flux:button variant="primary" class="cursor-pointer" wire:click="cambiarEstado({{ $rol->id_rol }})">
                                                        Cambiar estado
                                                    </flux:button>
                                                </div>
                                            </div>
                                        </flux:modal>
                                    </td>
                                    <td class="px-3 py-2 border-l border-zinc-200 dark:border-zinc-800">
                                        <div class="flex items-center justify-center">
                                            <flux:dropdown position="bottom" align="end">
                                                <flux:button variant="filled" size="sm" inset="bottom" icon="ellipsis-horizontal" class="cursor-pointer" />

                                                <flux:menu>
                                                    <flux:menu.item
                                                        href="{{ route('seguridad.controles.editar', ['id_rol' => $rol->id_rol]) }}"
                                                        icon="square-pen"
                                                        class="cursor-pointer"
                                                        wire:navigate
                                                    >
                                                        Editar
                                                    </flux:menu.item>
                                                    <flux:menu.separator />
                                                    <flux:modal.trigger name="eliminar-{{ $rol->id_rol }}">
                                                        <flux:menu.item icon="trash-2" class="cursor-pointer" variant="danger">Eliminar</flux:menu.item>
                                                    </flux:modal.trigger>
                                                </flux:menu>
                                            </flux:dropdown>
                                            <!-- Modal eliminar rol -->
                                            <flux:modal
                                                name="eliminar-{{ $rol->id_rol }}"
                                                class="min-w-[18rem] dark:bg-zinc-950 border dark:border-zinc-800" wire:key="modal-eliminar-{{ $rol->id_rol }}"
                                            >
                                                <div class="space-y-6">
                                                    <div>
                                                        <flux:heading size="lg">
                                                            Eliminar rol
                                                        </flux:heading>

                                                        <flux:subheading>
                                                            <p>
                                                                ¿Está seguro de que desea eliminar el rol "{{ $rol->nombre_rol }}"?
                                                            </p>
                                                        </flux:subheading>
                                                    </div>

                                                    <div class="flex gap-2">
                                                        <flux:spacer />

                                                        <flux:modal.close>
                                                            <flux:button variant="ghost" class="cursor-pointer">Cancelar</flux:button>
                                                        </flux:modal.close>

                                                        <flux:button variant="danger" class="cursor-pointer" wire:click="eliminar({{ $rol->id_rol }})">
                                                            Eliminar
                                                        </flux:button>
                                                    </div>
                                                </div>
                                            </flux:modal>
                                        </div>
                                    </td>
                                </tr> --}}
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        <div class="flex flex-col justify-center items-center gap-3 py-15 text-zinc-500 dark:text-zinc-400">
                                            <flux:icon name="triangle-alert" class="size-8" />
                                            <span>
                                                No se encontraron resultados
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div
                        class="absolute inset-0 bg-white dark:bg-zinc-800 opacity-50"
                        wire:loading
                        wire:target="buscar, mostrar"
                    ></div>
                    <div
                        class="flex justify-center items-center absolute inset-0 bd-white dark:bd-zinc-800 opacity-50"
                        wire:loading.flex
                        wire:target="buscar, mostrar"
                    >
                        <flux:icon.loading class="size-8" />
                    </div>
                </div>
                <div class="px-3 py-2 mb-0 bg-zinc-100 text-sm text-zinc-700 dark:bg-zinc-950 dark:text-zinc-100 border-t border-zinc-200 dark:border-zinc-800">
                    <div class="flex justify-between">
                        <div class="flex items-center text-sm text-zinc-500 dark:text-zinc-400">
                            Mostrando {{ $this->controles->firstItem() }} - {{ $this->controles->lastItem() }} de
                            {{ $this->controles->total() }} registros
                        </div>
                        {{ $this->controles->links() }}
                    </div>
                </div>
            </x-card>
        </div>
    </x-main>
</div>

<script>
    this.$js.limpiarBuscar = () => {
        this.buscar = '';
    };
</script>
