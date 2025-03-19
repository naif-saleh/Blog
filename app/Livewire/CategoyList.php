<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use Livewire\Component;

class CategoyList extends Component
{
    public function render()
    {
        return view('livewire.categoy-list', [
          'categories' => Category::orderBy('title', 'desc')->get()
        ]);
    }
}
