<?php

namespace App\Http\Livewire\Blog;

use Livewire\Component;

class TrixMetaInfo extends Component
{
    const EVENT_META_INFO_UPDATED = 'trix_meta_info_updated';

    public $metainfo;
    public $trixId;

    public function mount($metainfo = ''){
        $this->metainfo = $metainfo;
        $this->trixId = 'meta_info';
    }

    public function updatedMetaInfo($metainfo){
        $this->emit(self::EVENT_META_INFO_UPDATED, $this->metainfo);
    }

    public function render()
    {
        return view('livewire.blog.trix-meta-info');
    }
}
