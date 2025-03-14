<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class PostList extends Component
{

    #[Url()]
    public $sort = 'desc';
    public $search = '';

    public function sortBy($sort)
    {
        $this->sort = ($sort === 'desc') ? 'desc': 'asc';
    }

    #[On('search')]
    public function updatedSearch($search)
    {
        $this->search = $search;
    }
    public function render()
    {
        return view('livewire.post-list', [
            'posts' => Post::orderBy('published_at', $this->sort)->where('title', 'like', "%{$this->search}%")->paginate(5),
        ]);
    }
}
