<x-app-layout>

    {{-- dd($posts) --}}
    <div class="flex-col flex max-w-3xl gap-2 mx-auto">

        {{-- Left Side --}}
        <div class="w-[30rem] mx-auto lg:w-[95rem]">
            {{-- dd($posts ) --}}
            @forelse($posts as $post)
            
            <x-post :post='$post'/>
            
            @empty
            <div class=" max-w-2xl mx-auto">
                <p class="text-center text-gray-500">{{ __("No posts yet. Follow users to see their posts.") }}</p>
            </div>
            @endforelse
        </div>


    </div>




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