<x-app-layout>
<div class="mt-8 grid grid-cols-3 gap-1 md:gap-1">
    @foreach ($posts as $post)
    
        <div class="">
            <a href="{{ route('post.show' , $post->slug) }}">
                <img src="{{ asset('storage/posts/' . $post->imagepost->first()->image_path) }}" class="w-full h-64 object-cover rounded" alt="">
            </a>
        </div>
    @endforeach
</div>
<div class="mt-4">
    {{ $posts->links() }}
</div>




</x-app-layout>