<div wire:init="loadPosts">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="px-5 py-3 d-flex items-center">
                <div class="flex items-center">
                    <span>Mostar</span>
                    <select wire:model="cant" class="mx-2">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span>entradas</span>
                </div>
                <x-jet-input class="flex-1 mx-4" type="text" wire:model="search" placeholder="🔎Buscar🔎" />
                @livewire('create-post')
            </div>
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="cursor-pointer" wire:click="order('id')" style="width: 60px;">Id <i class="{{ $sort == 'id' ? ($direction == 'asc' ? 'bi bi-sort-numeric-down' : 'bi bi-sort-numeric-up') : 'bi bi-filter' }}"></i></th>
                        <th scope="col" class="cursor-pointer" wire:click="order('title')">Title <i class="{{ $sort == 'title' ? ($direction == 'asc' ? 'bi bi-sort-alpha-down' : 'bi bi-sort-alpha-up') : 'bi bi-filter' }}"></i></th>
                        <th scope="col" class="cursor-pointer" wire:click="order('content')">Content <i class="{{ $sort == 'content' ? ($direction == 'asc' ? 'bi bi-sort-alpha-down' : 'bi bi-sort-alpha-up') : 'bi bi-filter' }}"></i></th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post_item)
                        <tr>
                            <th scope="row">{{ $post_item->id }}</th>
                            <td>{{ $post_item->title }}</td>
                            <td>{{ $post_item->content }}</td>
                            <td class="flex h-full">
                                {{-- @livewire('edit-post', ['post' => $post_item]) si invocamos este componente sin su key, va a dar error al ser repetitivo --}}
                                {{-- @livewire('edit-post', ['post' => $post_item], key($post_item->id)) aqui ya jala sin problemas, pero estamos llamando modales lo cual lo vuelve lento --}}
                                <a class="btn btn-success" wire:click="edit({{ $post_item }})">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a class="btn btn-danger ml-2" wire:click="$emit('deletePost', {{ $post_item->id }})">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr class="table-danger">
                            <th scope="row" colspan="4" class="text-center">Sin resultados 😟</th>
                        </tr>
                    @endforelse
                </tbody>

            </table>
            @if (count($posts))
                @if ($posts->hasPages())
                    <div class="px-6 py-4">
                        {{ $posts->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>

    <x-jet-dialog-modal wire:model="open_edit">
        <x-slot name="title">
            <p class="text-dark">Editar el post</p>
        </x-slot>

        <x-slot name="content">
            <div class="text-dark mb-4">
                <x-jet-label value="Título del post" />
                <x-jet-input wire:model.defer="post.title" type="text" class="w-full" />
                <x-jet-input-error for="post.title" />

            </div>

            <div class="text-dark mb-4">
                <x-jet-label value="Contenido del post" />
                <textarea rows="6" wire:model.defer="post.content" class="form-control w-full"></textarea>
                <x-jet-input-error for="post.content" />

            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open_edit', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="update()" wire:loading.attr="disabled" wire:target="update" class="disabled:opacity-25">
                Actualizar
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

    @push('js')
        <script>
            Livewire.on('deletePost', postId => {
                Swal.fire({
                    title: '¿Estas seguro de eliminar el post?',
                    text: 'Esta información no podra recuperarse',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, Eliminar',
                    cancelButtonText: 'No, Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo('show-posts', 'delete', postId);
                    }
                })
            })

            Livewire.on('post_deleted', message => {
                Swal.fire(
                    'Eliminado',
                    message,
                    'success'
                )
            })
        </script>
    @endpush
</div>
