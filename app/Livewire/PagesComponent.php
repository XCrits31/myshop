<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class PagesComponent extends Component
{
    public function render()
    {
        return view('livewire.pages-component')->with([
            'all' => Category::all()
        ]);
    }
}
