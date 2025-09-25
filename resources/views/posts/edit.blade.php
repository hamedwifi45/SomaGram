<x-app-layout>
    <div class="card p-10 w-full ">
        <h1 class="text-3xl mb-10">{{ __("Edit Post") }}</h1>

        <div class="flex flex-col justify-center items-center w-full ">
            @if ($errors->any())
            <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                {{ __("Something went wrong") }}
            </div>
            <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('post.update',$post->slug) }}" enctype="multipart/form-data" class="w-full" method="post">
                @csrf
                @method('PUT')
                <x-create-edit :post="$post" :images="$images"/>
                <x-primary-button class="mt-4">{{ __('Uodate Post') }}</x-primary-button>
            </form>
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