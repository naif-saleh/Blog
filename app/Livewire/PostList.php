<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class PostList extends Component
{

    #[Url()]
    public $sort = 'desc';
    public $search = '';
    #[Url()]
    public $category = '';

    public function sortBy($sort)
    {
        $this->sort = ($sort === 'desc') ? 'desc': 'asc';
    }

    #[On('search')]
    public function updatedSearch($search)
    {
        $this->search = $search;
    }

    #[Computed()]
    public function activeCategory()
    {
        return Category::where('slug', $this->category)->first();
    }

    public function resetFilters(){
        $this->reset(['search', 'category']);
        // $this->restePage();
    }

    public function render()
    {
        return view('livewire.post-list', [
            'posts' => Post::
            orderBy('published_at', $this->sort)
            ->where('title', 'like', "%{$this->search}%")
            ->when($this->activeCategory(), function($query){
                $query->withCategory($this->category);
            })
            ->paginate(5),
        ]);
    }
}
