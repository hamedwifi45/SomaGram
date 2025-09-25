<x-app-layout>

    <div class="flex-row flex max-w-3xl gap-8 mx-auto">

    {{-- Left Side --}}
    <div class="w-[30rem] mx-auto lg:w-[95rem]></div>
    @forelse($posts as $post)
    
    <x-post :post='$post' />
    
    @empty
        <div class="max-w-2xl mx-auto">
            <p class="text-center text-gray-500">{{ __("No posts yet. Follow users to see their posts.") }}</p>
        </div>

    @endforelse
    

    </div>

</x-app-layout>