<?php

use Livewire\Volt\Component;

new class extends Component {
    public $dollarRating;

    public function mount($dollarRating = 0)
    {
        $this->dollarRating = $dollarRating;
    }
}; ?>

<div class="flex items-center">
    @for ($i = 1; $i <= 4; $i++)
        <span wire:click="setRating({{ $i }})"
            class="cursor-pointer text-2xl {{ $i <= $dollarRating ? 'text-green-500' : 'text-gray-400' }}">
            $
        </span>
    @endfor
</div>
