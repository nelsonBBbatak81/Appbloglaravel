<div>
    <div class="px-5 py-5 border border-solid border-stone-300 shadow-md">
    <div class="flex flex-row justify-end mb-1">
        <a
            href="{{ route('blogs') }}"
            class="border border-gray-700 bg-gray-700 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-gray-800 focus:outline-none focus:shadow-outline"
        >
            Back
        </a>
    </div>
        <div class="flex flex-col">
            <div class="flex flex-row mb-2">
                <p class="text-bold w-1/5">Title</p>
                <p class="w-full">{{ $title }}</p>
            </div>
            <div class="flex flex-row mb-2">
                <p class="text-bold w-1/5">Sub Title</p>
                <p class="w-full">{{ $subtitle }}</p>
            </div>
            <div class="flex flex-row mb-2">
                <p class="text-bold w-1/5">Category</p>
                <p class="w-full">{{ $category }}</p>
            </div>
            <div class="flex flex-row mb-2">
                <p class="text-bold w-1/5">Slug</p>
                <p class="w-full">{{ $slug }}</p>
            </div>
            <div class="flex flex-row mb-2">
                <p class="text-bold w-1/5">Meta Info</p>
                <p class="w-full">{{substr($meta_info,0, 100) }} ...</p>
            </div>
            <div class="flex flex-row mb-2">
                <div class="text-bold w-1/5">Content</div>
                <div class="w-full text-justify">{!! substr($content, 0, 150) !!} ...</div>
            </div>
            <div class="flex flex-row mb-2">
                <p class="text-bold w-1/5">Image</p>
                <p class="w-full"><img src="{{ asset('storage/images/blog') . '/' . $urlimage }}" alt="Image Blog" class="w-full h-24 object-fill"></p>
            </div>
            <div class="flex flex-row mb-2">
                <p class="text-bold w-1/5">Tags</p>
                <div class="w-full">
                    @foreach($tags as $tag)
                        <span class="px-2 py-2 bg-blue-400 text-white text-bold rounded-md">{{$tag}}</span>
                    @endforeach
                </div>
            </div>
            <div class="flex flex-row">
                <p class="text-bold w-1/5">Blog Images</p>
                <div class="w-full flex flex-col">
                    @foreach($blogimages as $item)
                        <img src="{{ $item }}" alt="Image Blog" class="w-24 h-16 mb-2">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
