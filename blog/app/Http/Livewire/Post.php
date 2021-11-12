<?php

namespace App\Http\Livewire;

use App\Models\Post as BlogPost;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Post extends Component
{
    public $post;
    public $comment;

    protected $rules = [
        'comment' => 'required|min:6',
    ];

    public function mount($slug)
    {
        $this->post = BlogPost::with('comments')->where('slug', $slug)->first();
    }

    public function saveComment()
    {
        DB::table('comments')->insert([
            'post_id' => $this->post->id,
            'user_id' => -1,
            'content' => $this->comment,
        ]);

        $this->post->refresh();
    }

    public function render()
    {
        return view('livewire.post')
            ->extends('layouts.app')
            ->section('content');
    }
}
