<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LikePost extends Component
{
    public $post;
    public $isLiked;


    // ? Funciona como un constructor, se llama apenas se instancia el componente
    public function mount($post){
        if (Auth::check()){
            $this->isLiked = $post->checkLike(auth()->user());
        }
    }

    public function like()
    {
        if ($this->post->checkLike(auth()->user())) {
            $this->post->likes()->where('user_id', auth()->user()->id)->delete();
            $this->isLiked = false;
        } else {
            $this->post->likes()->create([
                'user_id' => auth()->user()->id
            ]);
            $this->isLiked = true;
        }
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
