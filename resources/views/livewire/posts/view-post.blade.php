<?php

use Livewire\Volt\Component;
use App\Models\Post;
use App\Models\Comment;

new class extends Component {
    public Post $post;
    public function mount(Post $post)
    {
        $this->fill($post);
    }
}; ?>

<div>
    view post {{ $post->title }}
</div>
