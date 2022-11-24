@push('styles')
<style>
  .ck-editor__editable_inline {
    height: 300px;
    overflow-y: hidden;
}
</style>
@endpush

<div x-data="{}">
<div wire:loading wire:target="store">
        <livewire:components.spinner>
    </div>
<div class="flex items-center justify-center p-12 animate__animated animate__fadeInDown">
  <div class="mx-auto w-full max-w-[550px]">
  <div class="flex flex-row justify-end mb-1">
        <a
            href="{{ route('blogs') }}"
            class="border border-gray-700 bg-gray-700 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-gray-800 focus:outline-none focus:shadow-outline"
        >
            Back
        </a>
    </div>
    <form method="POST" wire:submit.prevent="store" enctype="multipart/form-data">
        @csrf
      <div class="-mx-3 flex flex-wrap">
        <div class="w-full px-3">
          <div class="mb-5">
            <label
              for="fName"
              class="mb-3 block text-base font-medium text-[#07074D]"
            >
              Title
            </label>
            <input
              type="text"
              wire:model="title"
              placeholder="Title"
              class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
            />
            @error('title') <span class="font-medium text-sm text-red-600">{{ $message }}</span> @enderror
          </div><!-- end div mb-5 -->
          <div class="mb-5">
            <label
              for="fSubtitle"
              class="mb-3 block text-base font-medium text-[#07074D]"
            >
              Sub Title
            </label>
            <input
              type="text"
              wire:model="subtitle"
              placeholder="Fill sub title blog .."
              class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
            />
            @error('subtitle') <span class="font-medium text-sm text-red-600">{{ $message }}</span> @enderror
          </div><!-- end div mb-5 -->
          <div class="mb-5">
            <label
              for="fSubtitle"
              class="mb-3 block text-base font-medium text-[#07074D]"
            >
              Category
            </label>
            <select name="" id="" wire:model="category_id" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                <option value=""></option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
            @error('category_id') <span class="font-medium text-sm text-red-600">{{ $message }}</span> @enderror
          </div><!-- end div mb-5 -->
          <div class="mb-5">
            <label
              for="fTag"
              class="mb-3 block text-base font-medium text-[#07074D]"
            >
              Tags
            </label>
            <div wire:ignore>
            <input
                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                wire:model="tags"
                id="tag_id"
                />
            </div
            @error('content') <span class="font-medium text-sm text-red-600">{{ $message }}</span> @enderror
          </div><!-- end div mb-5 -->
          <div class="mb-5">
          <label
              for="fName"
              class="mb-3 block text-base font-medium text-[#07074D]"
            >
              Meta Info
            </label>
            <textarea name="" id="" cols="30" rows="5" wire:model="meta_info" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"></textarea>
            @error('meta_info') <span class="font-medium text-sm text-red-600">{{ $message }}</span> @enderror
          </div><!-- end div mb-5 -->
          <div class="mb-5">
            <label
              for="fContent"
              class="mb-3 block text-base font-medium text-[#07074D]"
            >
              Content
            </label>
            <div wire:ignore>
            <textarea wire:ignore wire:key="editor-{{ now() }}" wire:model.lazy="content" class="form-control required" name="content" id="content"></textarea>

            </div>
            @error('content') <span class="font-medium text-sm text-red-600">{{ $message }}</span> @enderror
          </div><!-- end div mb-5 -->
          <div class="mb-5">
            <label
              for="fName"
              class="mb-3 block text-base font-medium text-[#07074D]"
            >
              Figure
            </label>
            <input
              type="file"
              x-ref="file"
              wire:model="urlimage"
              class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
            />
            @error('urlimage') <span class="font-medium text-sm text-red-600">{{ $message }}</span> @enderror
            <div wire:loading wire:target="urlimage">Uploading...</div>
            @if ($urlimage)

                Photo Preview:

                <img src="{{ $urlimage->temporaryUrl() }}" width="100%" height="150px" @click="$refs.file.click()">

            @endif
          </div><!-- end div mb-5 -->

        </div><!-- end div w-full px-3 -->
      </div>
      <div>
        <button
            type="submit"
          class="hover:shadow-form w-full rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none disabled:opacity-25 transition"
          {{ $isValid ? '' : 'disabled' }}
        >
          Submit
        </button>
      </div>
    </form>
  </div>
</div>
</div>

@push('scripts')
    <script src="{{ asset('js/choices.min.js') }}"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function (event) {
    const element = document.getElementById("tag_id");
    const example = new Choices(element, {
        maxItemCount: 4,
        delimiter: ",",
        editItems: true,
        removeItemButton: true,
    });

    document.getElementById("tag_id").addEventListener("change", () => {
        this.value = example.getValue(true);
        console.log(this.value);
        @this.set('tags', this.value);
    });
});
    </script>
<script>
     document.addEventListener('livewire:load', function () {
        const editor = CKEDITOR.replace('content', {
                filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
            });
            editor.on('change', function(event){
                console.log(event.editor.getData())
                @this.set('content', event.editor.getData());
            });
     });
</script>



@endpush
