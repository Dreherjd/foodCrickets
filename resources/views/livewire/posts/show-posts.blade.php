<?php

use Livewire\Volt\Component;
use App\Models\Post;

new class extends Component {
    public function with(): array
    {
        return [
            'posts' => Post::orderBy('created_at', 'desc')->get(),
        ];
    }
}; ?>

<div class="mt-4">
    @foreach ($posts as $post)
        @if ($loop->first)
            <div wire:key='{{ $post->id }}' class="flex space-y-4">
                <div class="border border-gray-300 rounded-lg shadow-2xl p-4 max-w-sm mx-auto col-auto ">
                    <img src="{{ URL::asset('/storage/' . $post->pic_link) }}" alt="{{ $post->alt_text }}" height="400"
                        width="400" class="rounded-lg" />
                </div>
                <div class="flex flex-col col-auto">
                    <p class="text-2xl mx-4 mb-2 font-semibold text-secondary">{{ $post->title }}</p>
                    <p class="text-xs mb-2 mx-4 text-stone-500">{{ $post->user->name }}</p>
                    <p class="mx-4 mb-2">{{ Str::limit($post->content, 100) }}</p>
                    <x-button class="mx-4" style="background-color:var(--color-primary);color:black;"
                        label="View" />
                </div>
            </div>
        @else
            @if ($loop->iteration == 2)
                <!-- Start the grid after the first post -->
                <div class="grid grid-cols-3 gap-4">
            @endif
            <div wire:key='{{ $post->id }}' class="flex flex-col w-full">
                <img src="{{ URL::asset('/storage/' . $post->pic_link) }}" alt="{{ $post->alt_text }}"
                    class="w-full h-auto max-h-48 object-cover" />
                <p class="mt-2 font-semibold text-secondary">{{ Str::limit($post->title, 25) }}</p>
                <p class="mt-2 text-xs text-stone-500">{{ $post->user->name }}</p>
                <p class="mt-2 break-words">{{ Str::limit($post->content, 75) }}</p>
                <x-button class="mt-2" style="background-color:var(--color-primary);color:black;" label="View" />
            </div>
            @if ($loop->last)
                <!-- Close the grid after the last post -->
                </div>
            @endif
        @endif
    @endforeach
</div>
