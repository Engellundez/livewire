<div>
    <x-jet-danger-button wire:click="$set('open', true)">
        Crear nuevo post
    </x-jet-danger-button>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Crear nuevo post
        </x-slot>
        <x-slot name="content">

            <div wire:loading wire:target="image">
                <b style="color: red;">¡Cargando Imagen!</b> <span style="color: red;">Espere un momento</span>
            </div>

            @if ($image)
                <img src="{{ $image->temporaryUrl() }}" class="mb-4">
            @endif

            <div class="mb-4">
                <x-jet-label value="Título del post"></x-jet-label>
                <x-jet-input type="text" class="form-control" wire:model.defer="title"></x-jet-input>

                <x-jet-input-error for="title" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Contenido del post"></x-jet-label>
                <textarea class="w-full form-control" rows="6" wire:model.defer="content"></textarea>

                <x-jet-input-error for="content" />
            </div>

            <div>
                <input type="file" wire:model.defer="image" id="{{ $identificador }}">

                <x-jet-input-error for="image" />
            </div>

        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="save()" wire:loading.attr="disabled" wire:target="save, image" class="disabled:opacity-25">
                Crear Post
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
