<?php

namespace App\Http\Livewire\Tag;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Tag;

class Index extends Component
{
    public function render()
    {
        return view('livewire.tag.index', [
            'tags' => Tag::orderBy("created_at", "desc")->paginate(2),
        ]);
    }

    public function deleteTag($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        $this->dispatchBrowserEvent('swal:modal', [

            'type' => 'success',

            'message' => 'Tag with id ' . $tag->id . ' successfully deleted!.',

        ]);
    }
}
