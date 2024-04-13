<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Dev extends Component
{
    public $nick;
    public $dev;

    public function mount($nick)
    {
        $this->dev = User::where('nickname', $nick)->first();
        if (!$this->dev) {
            return redirect()->route('dev.notfound');
        }

        $this->dev->primary_color = strval($this->dev->primary_color);
    }
    public function render()
    {
        return view('livewire.dev');
    }

}
