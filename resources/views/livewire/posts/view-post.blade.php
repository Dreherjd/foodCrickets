<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Tag;

new class extends Component {
    public Post $post;
    // public array $tags;
    public function mount(Post $post)
    {
        $this->fill($post);
    }

    // public function with(){
    //     //here's where we'll load tags, when we have them
    // }
}; ?>

<div class="container mx-auto px-40">
    <x-button xs style="background-color:var(--color-secondary);" class="mb-2" href="{{ url()->previous() }}" icon="arrow-long-left" label="Back" />
    <p class="text-3xl">{{ $post->title }}</p>
    <p class="text-xs text-stone-500">{{ $post->user->name }} | {{ $post->created_at->diffForHumans() }}</p>
    <x-badge style="background-color:var(--color-primary);color:black;" label="Fast Food" />
    <div class="flex mt-4">
        <img src="{{ URL::asset('/storage/' . $post->pic_link) }}" alt="{{ $post->alt_text }}" height="400" width="400"
        class="w-auto h-auto object-cover rounded-lg" />
    </div>
    <div style="white-space:pre-line;">
        {{ $post->content }}
    </div>
</div>
