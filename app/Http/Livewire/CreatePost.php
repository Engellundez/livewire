<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePost extends Component
{
	use WithFileUploads;

	public $open = false;

	public $title, $content, $image, $identificador;

	protected $rules = [
		'title' => 'required',
		'content' => 'required',
		'image' => 'nullable|image'
	];

	public function mount()
	{
		$this->identificador = rand();
	}

	// public function updated($property_name) // método que se activa cada que se actualiza alguna propiedad
	// {
	// 	$this->validateOnly($property_name);  // esta función nos serviría para validar las reglas de las variables que se modifican. de title quitando el defer
	// }

	public function save()
	{
		$this->validate();

		if ($this->image) {
			$image = $this->image->store('posts');
		}

		Post::create([
			'title' => $this->title,
			'content' => $this->content,
			'image' => $image ?? NULL,
		]);

		$this->reset(['open', 'title', 'content', 'image']);

		$this->identificador = rand();

		$this->emitTo('show-posts', 'render'); // emite un componente en especifico
		$this->emit('alert', 'El post se creó satisfactoriamente 😎'); // emite un componente global
	}

	public function render()
	{
		return view('livewire.create-post');
	}

	public function updatingOpen()
	{
		if ($this->open === false) {
			$this->reset(['title', 'content', 'image']);
			$this->identificador = rand();
		}
	}
}
