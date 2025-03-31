<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Tag;

new class extends Component {
    protected $listeners = [
        'refresh-component' => '$refresh',
    ];

    public Post $post;

    public function mount(Post $post)
    {
        $this->fill($post);
    }

    public function with(): array
    {
        return [
            'comments' => Comment::where('post_id', $this->post->id)->orderBy('created_at', 'desc')->get(),
            // here's where tags will get loaded when we get there.
        ];
    }

    public function likePost($post_id)
    {
        $post = Post::where('id', $post_id)->first();
        $like_count = $post->like_count;
        $like_count++;
        $post->like_count = $like_count;
        $post->save();
        $this->dispatch('refresh-component');
    }

    public function deleteComment($comment_id)
    {
        $comment = Comment::where('id', $comment_id)->first();
        $comment->delete();
    }
}; ?>

<div class="container mx-auto px-40">
    <p class="text-3xl">{{ $post->title }}</p>
    <p class="text-xs text-stone-500">{{ $post->user->name }} | {{ $post->created_at->diffForHumans() }}</p>
    <div class="space-y-1 mt-2">
        {{-- <x-badge style="background-color:var(--color-primary);color:black;" label="Fast Food" /> --}}
        @if ($post->would_go_back)
            <x-badge style="background-color:var(--color-primary);color:black;" label="Would Go Back" />
        @endif
        @if ($post->hall_of_fame)
            <x-badge style="background-color:var(--color-primary);color:black;" label="Hall of Fame" />
        @endif
    </div>
    @if ($post->rating && $post->dollar_rating)
        <div class="mb-2 mt-2 flex items-center space-x-2">
            <livewire:posts.star-rating :rating="$post->rating" />
            <livewire:posts.dollar-rating :dollarRating="$post->dollar_rating" />
        </div>
    @else
        <p>No rating given</p>
    @endif

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
            <x-button href="{{ route('comment.create', $post) }}" label="Leave a Comment"
                style="background-color:var(--color-primary);color:black;" />
        </div>
        <div class="bg-custom-primary flex items-center space-x-4">
            <x-button icon="hand-thumb-up" wire:click="likePost('{{ $post->id }}')" class="px-4 py-2 rounded"
                style="background-color:var(--color-primary);color:black;" label="{{ $post->like_count }}" />
        </div>
    </div>
    @foreach ($comments as $comment)
        <x-card class="mt-4" title="{{ $comment->user->name }} - {{ $comment->created_at->diffForHumans() }}"
            rounded="2xl" shadow="2xl">
            <x-slot name="slot">
                {{ $comment->content }}
            </x-slot>
            <x-slot name="footer" class="flex items-center space-x-2">
                <x-button style="background-color:var(--color-warning);"
                    wire:click="deleteComment('{{ $comment->id }}')" href="#" label="Delete" />
                <x-button href="{{ route('comment.edit', $comment) }}" style="background-color:var(--color-secondary);"
                    label="Edit" />
            </x-slot>
        </x-card>
    @endforeach
</div>
