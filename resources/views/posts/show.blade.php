<x-app-layout>
    <div class="h-screen md:flex md:flex-row justify-center items-center bg-gray-100">
        <!-- <div class="flex w-full  h-[80vh] bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-200"> -->

            {{-- Left side (Images + navigation) --}}
            <div class="relative h-full  overflow-hidden md:w-7/12 bg-black flex items-center justify-center">
                @foreach ($images as $index => $image)
                    <img src="{{ asset('storage/posts/' . $image->image_path) }}" 
                         alt="post image"
                         class="w-full h-full object-contain object-fit-cover absolute transition-opacity duration-500 
                         {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}"
                         data-image="{{ $index }}">
                @endforeach

                {{-- Prev button --}}
                <button class="absolute left-3 bg-white/50 hover:bg-white text-gray-700 rounded-full p-2"
                        onclick="prevImage()">
                    ‹
                </button>

                {{-- Next button --}}
                <button class="absolute right-3 bg-white/50 hover:bg-white text-gray-700 rounded-full p-2"
                        onclick="nextImage()">
                    ›
                </button>
            </div>
            {{-- Right side (Post details) --}}
            <div class="flex w-full flex-col h-full bg:white md:w-5/12 shadow-xl border border-gray-200">
                {{-- Top --}}
                <div class="border-b-2">
                    <div class="flex item-center gap-0 p-5">
                        <img src="{{ $post->owner->image }}" alt="{{ $post->owner->username }}" class="h-10 w-10 rounded-full object-cover border p-1 mr-5">
                        <div class="grow">
                            <a href="#" class="font-bold">
                                {{ $post->owner->username }}
                            </a>
                        </div>
                    
                    </div>
                </div>
                {{-- Middle --}}
                <div class="grow">
                    <div class="flex item-start px-5 py-2 gap-3">
                        <img src="{{ $post->owner->image }}" class=" ltr:mr-5 rtl:ml-5 h-10 w-10 rounded-full object-cover border p-1 mt-3">
                        <div class="flex flex-col">
                            <div class="inline">
                                <a href="#" class=" font-bold">
                                    {{ $post->owner->username }}
                                </a>
                            </div>
                            <span class="inline">{{ $post->caption }}

                            </span>
                            <div class="mt-1 text-sm text-gray-400">
                                {{ $post->created_at->diffForHumans(null,false,true) }}
                            </div>
                        </div>
                     </div>


                     {{-- Comments --}}

                     
                </div>
            </div>
        <!-- </div> -->
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
    </script>
</x-app-layout>
