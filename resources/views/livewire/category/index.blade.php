<div>
    @if($modalmode)
        <livewire:components.modal-delete :title="$titlemodal" :description="$descriptionmodal" />
    @elseif($listmode)
        <livewire:category.list-category />
    @elseif($addmode)
        <livewire:category.add-category />
    @elseif($editmode)
        <livewire:category.edit-category :category="$category" />
    @elseif($showmode)
        <livewire:category.show-category :category="$category" />
    @endif
</div>
