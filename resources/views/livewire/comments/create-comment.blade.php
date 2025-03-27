<?php

use Livewire\Volt\Component;
use App\Models\Post;
use App\Models\Comment;

new class extends Component {
    public Post $post;
    public $comment_content;

    public function mount($post)
    {
        $this->fill($post);
    }

    public function submit_comment()
    {
        $validated = $this->validate([
            'comment_content' => ['required', 'string', 'min:3'],
        ]);
        auth()
            ->user()
            ->comments()
            ->create([
                'content' => $this->comment_content,
                'post_id' => $this->post->id,
            ]);
        redirect(route('post.view', $this->post->id));
    }
}; ?>

<div>
    <div>
        <p class="text-2xl">What do you want to say?</p>
    </div>
    <form wire:submit='submit_comment'>
        <div class="flex mt-4">
            <x-textarea wire:model='comment_content' placeholder="Wow that looks really good!" />
        </div>
        <div class="pt-4">
            <x-button style="background-color:var(--color-warning);color:black;" label="Cancel" href="{{ route('post.view', $post->id) }}" />
            <x-button style="background-color:var(--color-primary);color:black;" label="Submit" spinner type="submit" />
        </div>
    </form>
</div>
