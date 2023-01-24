<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithFileUploads;

use Livewire\WithPagination;

class ShowPosts extends Component
{
	use WithFileUploads, WithPagination;

	public $open_edit = false;
	public $cant = '10';
	public $search, $post;
	public $sort = 'id';
	public $direction = 'desc';

	public $readyToLoad = false;

	protected $listeners = ['render', 'delete'];

	protected $rules = [
		'post.title' => 'required',
		'post.content' => 'required',
	];

	protected $queryString = [
		'cant' => ['except' => '10'],
		'sort' => ['except' => 'id'],
		'direction' => ['except' => 'desc'],
		'search' => ['except' => ''],
	];

	public function updatingSearch()
	{
		$this->resetPage();
	}

	public function render()
	{
		$posts = $this->readyToLoad
			? Post::where('title', 'like', '%' . $this->search . '%')
			->orWhere('content', 'like', '%' . $this->search . '%')
			->orderBy($this->sort, $this->direction)->paginate($this->cant)
			: [];

		return view('livewire.show-posts', compact('posts'));
	}

	public function order($sort)
	{
		$this->resetPage();
		if ($this->sort == $sort) {
			$this->direction = $this->direction == 'desc' ? 'asc' : 'desc';
		} else {
			$this->sort = $sort;
			$this->direction = 'asc';
		}
	}

	public function edit(Post $post)
	{
		$this->post = $post;
		$this->open_edit = true;
	}

	public function update()
	{
		$this->validate();

		$this->post->save();

		$this->reset(['open_edit']);

		$this->emit('edit', 'Se ha editado correctamente 👌🏽👌🏽');
	}

	public function loadPosts()
	{
		$this->readyToLoad = true;
	}

	public function delete(Post $post)
	{
		$post->delete();
		$this->emit('post_deleted', 'El post ha sido eliminado correctamente 👌🏽👌🏽');
	}
}
