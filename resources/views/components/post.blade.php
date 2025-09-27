<div class="card">
    {{-- header --}}
    <div class="card-header gap-1">
    <img src="{{ $post->owner->image }}" class="h-9  w-9 rounded-full">
     <a href="" class="font-bold">{{ $post->owner->username }}</a>
    </div>
    {{-- body --}}
    <div class="card-body">
        <div class="max-h- overflow-hidden" 35rem="">
            {{-- dd($images) --}}
            <div class="relative h-full overflow-hidden md:w-7/12 flex items-center justify-center bg-black rounded-l-2xl shadow-lg">
            @foreach ($post->imagepost as $index => $image)
                <img src="{{ asset('storage/posts/' . $image->image_path) }}"
                    alt="post image"
                    class="w-full h-full object-contain absolute transition-opacity duration-500 rounded-l-2xl
                           {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}"
                    data-image="{{ $index }}">
            @endforeach

            {{-- Prev button --}}
            <button class="absolute left-3 bg-white/40 hover:bg-white/70 text-gray-800 rounded-full p-2 backdrop-blur-md shadow-md"
                onclick="prevImage()">
                ‹
            </button>

            {{-- Next button --}}
            <button class="absolute right-3 bg-white/40 hover:bg-white/70 text-gray-800 rounded-full p-2 backdrop-blur-md shadow-md"
                onclick="nextImage()">
                ›
            </button>
        </div>
        </div>
</div>