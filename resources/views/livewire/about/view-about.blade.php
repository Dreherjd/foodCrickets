<?php

use Livewire\Volt\Component;
use App\Models\About;

new class extends Component {
    public About $about;

    public function with(){
        dd(About::all());
    }
    // public function with()
    // {
    //     return [
    //         //get the most recent about entry
    //         'about' => About::orderBy('created_at', 'DESC')->take(1)->get(),
    //     ];
    // }
}; ?>

<div>
    {{ $about->title }}
</div>
