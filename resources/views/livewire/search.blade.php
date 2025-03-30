<?php

use Livewire\Volt\Component;
use App\Models\Post;

new class extends Component {
    public string $searchTerm;
    public $results = [];

    protected $listeners = [
        'refresh-component' => '$refresh',
    ];

    public function search()
    {
        if (isset($this->searchTerm)) {
            $this->results = Post::query()
                ->whereRaw('MATCH (title, content, business_name) AGAINST (? IN BOOLEAN MODE)', [$this->searchTerm])
                ->get();
        }
    }

    public function resetSearchBox()
    {
        $this->searchTerm = '';
        $this->results = [];
        $this->dispatch('refresh-component');
    }
}; ?>

<div class="mt-4">
    <div class="flex flex-col items-center">
        <p class="text-3xl mb-4">Search</p>
        <input
            class="border border-gray-300 rounded-md p-2 w-64 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            wire:model='searchTerm' wire:keydown.enter="search" placeholder="Hot Dogs" />
        <div class="flex mt-2 space-x-2 w-64">
            <x-button class="flex-1" style="background-color:var(--color-warning);color:black;" right-icon="x-mark"
                wire:click="resetSearchBox()" label="Clear" />
            <x-button class="flex-1" style="background-color:var(--color-primary);color:black;"
                right-icon="arrow-long-right" wire:click="search()" spinner label="Search" />
        </div>

    </div>

    <div class="mt-4 space-y-4">
        <div class="grid grid-cols-3 gap-4">
            @foreach ($results as $item)
                <x-card title="{!! Str::limit($item->title, 25) !!} - {{ $item->created_at->diffForHumans() }}" shadow="2xl"
                    rounded="3xl">
                    {{ Str::limit($item->content, 100) }}
                    @if ($item->rating)
                        <div class="mb-2 mt-2 flex items-center space-x-2">
                            <livewire:posts.star-rating :rating="$item->rating" />
                            <livewire:posts.dollar-rating :dollarRating="$item->dollar_rating" />
                        </div>
                    @else
                        <p>No rating given</p>
                    @endif
                    @if ($item->business_name)
                        <div class="mb-2 mt-2 flex items-center space-x-2">
                            <p class="text-xs">{{ $item->business_name }} | {{ $item->business_addr }}</p>
                        </div>
                    @else
                        <p>No dollar rating given</p>
                    @endif
                    <x-slot name="footer" class="flex items-center justify-between" class="flex">
                        <x-button label="View Post" class="flex-1" href="{{ route('post.view', $item->id) }}"
                            style="background-color:var(--color-primary);color:black;" />
                    </x-slot>
                </x-card>
            @endforeach
        </div>
    </div>
</div>
