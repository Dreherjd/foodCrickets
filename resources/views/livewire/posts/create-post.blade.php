<?php

use Livewire\Volt\Component;
use Spatie\LivewireFilepond\WithFilePond;

new class extends Component {
    use WithFilePond;
    public $file;
    public $title;
    public $content;
    public $rating;
    public $dollar_rating;
    public $would_go_back;
    public $hall_of_fame;
    public $business_name;
    public $business_addr;
    public $alt_text;

    public function rules(): array
    {
        return [
            'file' => 'mimetypes:image/jpg,image/jpeg,image/png',
        ];
    }

    public function validateUploadedFile()
    {
        $this->validate();
        return true;
    }

    public function submit()
    {
        $validated = $this->validate([
            'title' => ['required', 'string', 'min:5'],
            'content' => ['required', 'string', 'min:20'],
            'rating' => ['required', 'string', 'min:1'],
            'dollar_rating' => ['string'],
            'business_name' => ['string', 'min:3'],
            'business_addr' => ['string'],
            'alt_text' => ['string', 'min:2'],
        ]);
        auth()
            ->user()
            ->posts()
            ->create([
                'title' => $this->title,
                'content' => $this->content,
                'rating' => $this->rating,
                'dollar_rating' => $this->dollar_rating,
                'would_go_back' => $this->would_go_back,
                'hall_of_fame' => $this->hall_of_fame,
                'business_name' => $this->business_name,
                'business_addr' => $this->business_addr,
                'alt_text' => $this->alt_text,
                'file' => $this->file,
            ]);
        redirect(route('dashboard'));
    }
}; ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/3.2.7/css/froala_editor.pkgd.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/3.2.7/js/froala_editor.pkgd.min.js"></script>

<div>
    <form wire:submit='submit' class="space-y-4">
        <p class="text-xl">Title</p>
        <x-input wire:model='title' />
        <x-textarea wire:model='content' id="editor" label="Post Content" />
        <x-input wire:model='rating' label="Rating" />
        <x-input wire:model='dollar_rating' label="Dollar Rating" />
        <x-checkbox wire:model='would_go_back' label="Would Go Back?" />
        <x-checkbox wire:model='hall_of_fame' label="Hall of Fame" />
        <x-input wire:model='business_name' label="Business Name" />
        <x-input wire:model='business_addr' label="Business Address" />
        <x-input wire:model='alt_text' label="Image Alt Text" />
        <x-filepond::upload wire:model='file' class="mt-4" multiple="false" wire:model="file" />
        @filepondScripts
        <x-button label="Submit" right-icon="arrow-right" type="submit" style="background-color:var(--color-primary);"
            spinner />
    </form>
</div>
<script>
    new FroalaEditor('#editor');
</script>
