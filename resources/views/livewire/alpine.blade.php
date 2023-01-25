<div>
    <p>
        Count: {{ $count }}
    </p>

    <button class="btn btn-success" wire:click="aumentar">
        Aumentar desde Livewire
    </button>
    <button class="btn btn-danger" wire:click="disminuir">
        Disminuir desde Livewire
    </button>

    {{-- utiliza el valor de la propiedad --}}
    {{-- <div x-data="{ count: $wire.count }"> --}}

    {{-- utiliza el valor de la propiedad y se sincroniza con livewire --}}
    {{-- <div x-data="{ count: @entangle('count') }"> --}}

    {{-- utiliza el valor de la propiedad y se sincroniza con livewire, pero espera hasta que livewire ejecute una funcion --}}
    <div x-data="{ count: @entangle('count').defer }">
        <p>Count dentro de Alpine con Defer <span x-text="count"></span></p>

        <button class="btn btn-success" @click="count++">
            Aumentar desde Alpine
        </button>
        <button class="btn btn-danger" @click="count--">
            Disminuir desde Alpine
        </button>
    </div>
    <div x-data="{ count: @entangle('count') }">
        <p>Count dentro de Alpine sin Defer <span x-text="count"></span></p>

        <button class="btn btn-success" @click="count++">
            Aumentar desde Alpine
        </button>
        <button class="btn btn-danger" @click="count--">
            Disminuir desde Alpine
        </button>
    </div>
</div>
