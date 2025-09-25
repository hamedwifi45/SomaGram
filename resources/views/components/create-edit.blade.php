@if (isset($post) && $images->count() > 0)
    <div class="relative h-32 overflow-hidden w-32 flex items-center justify-center rounded-l-2xl shadow-lg">
            @foreach ($images as $index => $image)
                <img src="{{ asset('storage/posts/' . $image->image_path) }}"
                    alt="post image"
                    class="w-32 h-32 object-contain absolute transition-opacity duration-500 rounded-l-2xl
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

@endif

<input class="w-full border border-gray-200 bg-gray-50 block focus:outline-none rounded-xl" name="image[]" value="{{ old('image') }}" multiple id="file_input" type="file">
<p class="text-sm mt-3 text-gray-500 dark:text-gray-300" id="file_input_help">PNG JPG or GIF</p>
<textarea name="caption" rows="5" class="mt-10 border border-gray-200 w-full rounded-xl" placeholder="{{ __("WRITE a CAPTION") }}">{{ old('caption',isset($post) ? $post->caption : '') }}</textarea>