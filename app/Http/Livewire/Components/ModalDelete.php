<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class ModalDelete extends Component
{
    public $titlemodal, $descriptionmodal;

    public function mount($title, $description) {
        $this->titlemodal = $title;
        $this->descriptionmodal = $description;
    }

    public function render()
    {
        return view('livewire.components.modal-delete');
    }

    public function closeModal() {
        $this->emit('close-modal-delete');
    }

    public function deleteItem() {

        $this->emit('delete-item');
    }
}
