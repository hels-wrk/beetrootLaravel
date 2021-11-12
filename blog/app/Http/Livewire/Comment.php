<?php

namespace App\Http\Livewire;

use App\Models\Comment as BlogComment;
use Livewire\Component;

class Comment extends Component
{
    public $comment;

    public function mount($slug){
        $this->comment = BlogComment::with('comments')->where('slug', $slug)->first();
    }

    public function render()
    {
        return view('livewire.post')
            ->extends('layouts.app')
            ->section('content');
    }
}
