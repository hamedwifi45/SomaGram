<x-app-layout>
<div class="mt-8 grid grid-cols-3 gap-1 md:gap-5">
    @foreach ($posts as $post)
    
        <div class="">
            <a href="{{ route('post.show' , $post->slug) }}">
                <img src="{{ asset('posts/' . $post->imagepost->first()) }}" class="w-full h-64 object-cover rounded" alt="">
            </a>
        </div>
    @endforeach
</div>




</x-app-layout>