<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class SliderPromo extends Component
{
    public function render()
    {
        return view('livewire.components.slider-promo',
        [
            'blogs' => DB::table('blogs')->orderBy('created_at', 'desc')->paginate(3),
        ]);
    }
}
