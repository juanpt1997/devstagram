<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    public $post;

    public function like()
    {
        if ($this->post->checkLike(auth()->user())) {
            $this->post->likes()->where('user_id', auth()->user()->id)->delete();
        } else {
            $this->post->likes()->create([
                'user_id' => auth()->user()->id
            ]);
        }
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
