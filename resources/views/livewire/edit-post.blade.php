<div>
    <a class="btn btn-success" wire:click="$set('open', true)">
        <i class="bi bi-pencil-square"></i>
    </a>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            <p class="text-dark">Editar el post</p>
        </x-slot>

        <x-slot name="content">
            <div class="text-dark mb-4">
                <x-jet-label value="Título del post" />
                <x-jet-input wire:model="post.title" type="text" class="w-full" />
                <x-jet-input-error for="post.title" />

            </div>

            <div class="text-dark mb-4">
                <x-jet-label value="Contenido del post" />
                <textarea rows="6" wire:model="post.content" class="form-control w-full"></textarea>
                <x-jet-input-error for="post.content" />

            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="save()" wire:loading.attr="disabled" wire:target="save" class="disabled:opacity-25">
                Actualizar
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
