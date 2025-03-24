<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div>
    <form wire:submit='submit' class="space-y-4">
        {{-- <x-input wire:model='title' label="Title" /> --}}
        <livewire:posts.tinymce wire:model='editor' />
    </form>
</div>
