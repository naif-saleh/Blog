<?php

namespace App\Livewire;

use Livewire\Component;

class SearchInput extends Component
{

    public $search = '';

    public function updatedSearch()
    {
        $this->dispatch('search', $this->search);
    }
    public function render()
    {
        return view('livewire.search-input');
    }
}
