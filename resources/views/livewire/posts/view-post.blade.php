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

    protected $listeners = [
        'refresh-component' => '$refresh',
    ];

    public function likePost($post_id)
    {
        $post = Post::where('id', $post_id)->first();
        $like_count = $post->like_count;
        $like_count++;
        $post->like_count = $like_count;
        $post->save();
        $this->dispatch('refresh-component');
    }

    // public function with(){
    //     //here's where we'll load tags, when we have them
    // }
}; ?>

<div class="container mx-auto px-40">
    <x-button xs class="mb-2 bg-secondary" href="{{ url()->previous() }}" icon="arrow-long-left" label="Back" />
    <p class="text-3xl">{{ $post->title }}</p>
    <p class="text-xs text-stone-500">{{ $post->user->name }} | {{ $post->created_at->diffForHumans() }}</p>
    <div class="space-y-1 mt-2">
        <x-badge class="bg-primary-custom" label="Fast Food" />
        @if ($post->would_go_back)
            <x-badge style="background-color:var(--color-primary);color:black;" label="Would Go Back" />
        @endif
        @if ($post->hall_of_fame)
            <x-badge style="background-color:var(--color-primary);color:black;" label="Hall of Fame" />
        @endif
    </div>
    <div class="space-y-2 mt-2">
        <livewire:posts.star-rating :rating="$post->rating">
    </div>

    <div class="flex mt-4">
        <img src="{{ URL::asset('/storage/' . $post->pic_link) }}" alt="{{ $post->alt_text }}" height="400"
            width="400" class="w-auto h-auto object-cover rounded-lg" />
    </div>
    @if ($post->business_name)
        <div class="mt-4 flex items-center justify-between p-4 bg-gray-100 border border-gray-300 rounded-lg">
            <div class="flex-1">
                <h2 class="text-lg font-semibold">{{ $post->business_name }}</h2>
                <p class="text-gray-600">{{ $post->business_addr }}</p>
            </div>
            <div class="flex items-center space-x-4">
                <x-button class="px-4 py-2 rounded" target="_blank"
                    href="http://www.google.com/search?q={{ $post->business_name }}+binghamton"
                    style="background-color:var(--color-info);" label="Directions" />
            </div>
        </div>
    @endif
    <div style="white-space:pre-line;">
        {{ $post->content }}
    </div>

    <div class="mt-4 flex items-center justify-between p-4 bg-gray-100 border border-gray-300 rounded-lg">
        <div class="flex-1">
            <h2 class="text-lg font-semibold">share your thoughts</h2>
            <p class="text-gray-600">Leave a comment</p>
        </div>
        <div class="bg-custom-primary flex items-center space-x-4">
            <x-button icon="hand-thumb-up" wire:click="likePost('{{ $post->id }}')" class="px-4 py-2 rounded"
                style="background-color:var(--color-primary);color:black;" label="{{ $post->like_count }}" />
        </div>
    </div>
</div>
