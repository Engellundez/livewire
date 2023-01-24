<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class CreatePost extends Component
{
	public $open = false;

	public $title, $content;

	protected $rules = [
		'title' => 'required|max:10',
		'content' => 'required'
	];

	// public function updated($property_name)
	// {
	// 	$this->validateOnly($property_name);  esta función nos serviría para validar las reglas de las variables que se modifican. de title quitando el defer
	// }

	public function save()
	{
		$this->validate();

		Post::create([
			'title' => $this->title,
			'content' => $this->content,
		]);

		$this->reset(['open', 'title', 'content']);

		$this->emitTo('show-posts', 'render'); // emite un componente en especifico
		$this->emit('alert', 'El post se creó satisfactoriamente 😎'); // emite un componente global
	}

	public function render()
	{
		return view('livewire.create-post');
	}
}
