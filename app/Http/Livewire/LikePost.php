<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    public $post;

    public function render()
    {
        return view('livewire.like-post');
    }
}
