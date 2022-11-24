<?php

namespace App\Http\Livewire\Blog;

use Livewire\Component;

class TrixContent extends Component
{
    const EVENT_CONTENT_UPDATED = 'trix_content_updated';

    public $content;
    public $trixId;

    public function mount($content = ''){
        $this->content = $content;
        $this->trixId = 'content';
    }

    public function updatedContent($content){
        $this->emit(self::EVENT_CONTENT_UPDATED, $this->content);
    }

    public function render()
    {
        return view('livewire.blog.trix-content');
    }
}
