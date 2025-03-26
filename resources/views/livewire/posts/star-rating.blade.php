<?php

use Livewire\Volt\Component;

new class extends Component {
    public $rating;

    public function mount($rating = 0)
    {
        $this->rating = $rating;
    }
}; ?>


<div class="flex items-center">
    @for ($i = 1; $i <= 5; $i++)
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 {{ $i <= $rating ? 'text-yellow-500' : 'text-gray-300' }}"
            fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 15.27L16.18 20l-1.64-7.03L20 8.24l-7.19-.61L10 1 7.19 7.63 0 8.24l5.46 4.73L3.82 20z" />
        </svg>
    @endfor
</div>
