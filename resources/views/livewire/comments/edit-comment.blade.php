<?php

use Livewire\Volt\Component;
use App\Models\Comment;
use Illuminate\Support\Facades\Log;

new class extends Component {
    public Comment $comment;
    public $comment_content;

    public function mount(Comment $comment)
    {
        //here's where you would authorize the action, if I could get the policy to work
        $this->fill($comment);
        $this->comment_content = $comment->content;
    }

    public function saveComment()
    {
        $this->validate([
            'comment_content' => ['required', 'string', 'min:3'],
        ]);
        $this->comment->update([
            'content' => $this->comment_content,
        ]);
        redirect(route('post.view', $this->comment->post_id));
    }
}; ?>

<div>
    <form wire:submit='saveComment'>
        <x-textarea wire:model='comment_content' label="Edit your comment" />
        <div class="pt-4">
            <x-button style="background-color:var(--color-warning);color:black;" label="Cancel"
                href="{{ route('post.view', $comment->post_id) }}" />
            <x-button style="background-color:var(--color-primary);color:black;" label="Submit" spinner type="submit" />
        </div>
    </form>
</div>
