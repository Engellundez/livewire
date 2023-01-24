<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="px-5 py-3 d-flex items-center">
                <x-jet-input class="flex-1 mr-4" type="text" wire:model="search" placeholder="🔎Buscar🔎">
                    </x-input>
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
                    @forelse ($posts as $post)
                        <tr>
                            <th scope="row">{{ $post->id }}</th>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->content }}</td>
                            <td><button class="btn btn-warning">edit</button></td>
                        </tr>
                    @empty
                        <tr class="table-danger">
                            <th scope="row" colspan="4" class="text-center">Sin resultados 😟</th>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
