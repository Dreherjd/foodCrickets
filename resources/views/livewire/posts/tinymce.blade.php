<?php

use Livewire\Volt\Component;

new class extends Component {
    public $message;
}; ?>

@push('styles')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
@endpush

<div class="mt-2 bg-white" wire:ignore>
  <div
       x-data
       x-ref="quillEditor"
       x-init="
         quill = new Quill($refs.quillEditor, {theme: 'snow'});
         quill.on('text-change', function () {
           $dispatch('input', quill.root.innerHTML);
         });
       "
       wire:model.debounce.2000ms="message"
  >
    {!! $message !!}
  </div>
</div>