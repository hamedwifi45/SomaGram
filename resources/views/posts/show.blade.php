<x-app-layout>
    <div class="h-screen md:flex md:flex-row justify-center items-center bg-gradient-to-br from-pink-100 via-purple-100 to-blue-100">

        {{-- Left side (Images + navigation) --}}
        <div class="relative h-full overflow-hidden md:w-7/12 flex items-center justify-center bg-black rounded-l-2xl shadow-lg">
            @foreach ($images as $index => $image)
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

        {{-- Right side (Post details) --}}
        <div class="flex w-full flex-col h-full bg-white md:w-5/12 shadow-xl rounded-r-2xl border border-gray-200">

            {{-- Top --}}
            <div class="border-b px-5 py-4 flex items-center gap-3">
                <img src="{{ $post->owner->image }}" alt="{{ $post->owner->username }}"
                     class="h-12 w-12 rounded-full object-cover border-2 border-pink-300 p-[2px]">
                <a href="#" class="font-bold text-gray-800 hover:text-pink-500">
                    {{ $post->owner->username }}
                </a>
            </div>

            {{-- Middle (caption + comments) --}}
            <div class="grow overflow-y-auto">
                <div class="flex items-start px-5 py-3 gap-3">
                    <img src="{{ $post->owner->image }}" class="h-10 w-10 rounded-full object-cover border">
                    <div class="flex flex-col">
                        <a href="#" class="font-bold text-gray-800 hover:text-pink-500">
                            {{ $post->owner->username }}
                        </a>
                        <span class="text-gray-700">{{ $post->caption }}</span>
                        <div class="mt-1 text-xs text-gray-400">
                            {{ $post->created_at->diffForHumans(null,false,true) }}
                        </div>
                    </div>
                </div>

                {{-- Comments --}}
                @foreach ($post->comments as $item)
                    <div class="flex items-start px-5 py-2 gap-3 hover:bg-gray-50 rounded-lg transition">
                        <img src="{{ $item->owner->image }}" alt="" class="h-9 w-9 rounded-full object-cover border">
                        <div class="flex flex-col">
                            <a href="" class="font-bold text-gray-800 hover:text-pink-500">
                                {{ $item->owner->username }}
                            </a>
                            <span class="text-gray-700">{{ $item->body }}</span>
                            <div class="mt-1 text-xs text-gray-400">
                                {{ $item->created_at->diffForHumans(null,false,true) }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div> 

            {{-- Bottom (comment input) --}}
            <div class="border-t p-4 bg-gray-50 rounded-b-2xl">
    <form action="{{ route('comment.store',$post->slug) }}" method="post">
        @csrf
        @if($errors->has('body'))
            <div class="text-red-500 text-sm mb-2">
                {{ $errors->first('body') }}
            </div>
        @endif

        <div class="flex items-center gap-3">
            <textarea 
                id="body"
                name="body"
                required
                placeholder="{{ __('Add a comment...') }}"
                class="flex-grow min-h-[40px] max-h-40 p-2 rounded-lg border focus:outline-none 
                       focus:ring-2 focus:ring-pink-300 text-gray-700 resize-none overflow-hidden leading-relaxed"
                oninput="autoResize(this)"
            ></textarea>

            <button 
                class="px-4 py-2 rounded-lg bg-pink-500 text-white font-semibold hover:bg-pink-600 transition">
                {{ __('Comment') }}
            </button>
        </div>
    </form>
</div>
        </div>
    </div>

    {{-- Script for image navigation --}}
    <script>
        let currentImage = 0;
        const images = document.querySelectorAll('[data-image]');

        function showImage(index) {
            images.forEach((img, i) => {
                img.classList.toggle('opacity-100', i === index);
                img.classList.toggle('opacity-0', i !== index);
            });
            currentImage = index;
        }

        function nextImage() {
            const newIndex = (currentImage + 1) % images.length;
            showImage(newIndex);
        }

        function prevImage() {
            const newIndex = (currentImage - 1 + images.length) % images.length;
            showImage(newIndex);
        }
        function autoResize(el) {
        el.style.height = 'auto';   // نعيدها افتراضية
        el.style.height = (el.scrollHeight) + 'px'; // نخليها قد النص
        }
    </script>
</x-app-layout>
