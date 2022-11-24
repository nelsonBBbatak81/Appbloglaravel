<div x-data="{}">
<div wire:loading wire:target="update">
        <livewire:components.spinner>
    </div>
<div class="flex items-center justify-center p-12 animate__animated animate__fadeInDown">
  <div class="mx-auto w-full max-w-[550px]">
  <div class="flex flex-row justify-end mb-1">
        <button
            wire:click="back"
            type="button"
            class="border border-gray-700 bg-gray-700 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-gray-800 focus:outline-none focus:shadow-outline"
        >
            Back
        </button>
    </div>
    <form method="POST" wire:submit.prevent="update" enctype="multipart/form-data">
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
              for="fName"
              class="mb-3 block text-base font-medium text-[#07074D]"
            >
              Meta Info
            </label>
            <textarea
                wire:model="meta_info"
                cols="30"
                rows="5"
                placeholder="Meta Info"
              class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
            ></textarea>
            @error('meta_info') <span class="font-medium text-sm text-red-600">{{ $message }}</span> @enderror
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
                <div @click="$refs.file.click()">
                Photo Preview:

                <img src="{{ $urlimage->temporaryUrl() }}" width="100%" height="50px">
                </div>
            @else
                <div @click="$refs.file.click()">
                 Photo Preview:
                <img src="/storage/images/category/{{$image}}" width="100%" height="50px">
                </div>
            @endif
          </div><!-- end div mb-5 -->
        </div><!-- end div w-full px-3 -->
      </div>
      <div>
        <button
            type="submit"
          class="hover:shadow-form w-full rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none disabled:opacity-25 transition"

        >
          Submit
        </button>
      </div>
    </form>
  </div>
</div>
</div>
