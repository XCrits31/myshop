<?php

namespace App\Livewire;

use Livewire\Component;

class TestComponent extends Component
{
    public $message = 'Нажмите на кнопку';

    public function changeMessage()
    {
        $this->message = 'Текст изменен!';
    }

    public function render()
    {
        return view('livewire.test-component');
    }
}
