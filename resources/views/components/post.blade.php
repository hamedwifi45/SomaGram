<div class="card bg-white rounded-2xl shadow-md overflow-hidden" data-post>
    {{-- header --}}
    <div class="card-header flex items-center gap-2 px-4 py-3 border-b">
        <img src="{{ $post->owner->image }}" class="h-10 w-10 rounded-full border shadow-sm">
        <a href="{{ route('post.show' , $post->slug) }}" class="font-bold text-gray-800 hover:text-pink-600 transition">
            {{ $post->owner->username }}
        </a>
    </div>

    {{-- body --}}
    <div class="card-body">

        <div class="relative w-full flex flex-col items-center justify-center bg-gray-50">
            {{-- الصور --}}
            @foreach ($images as $index => $image)
            <div class="w-full max-h-[35rem] overflow-hidden">
                <img src="{{ asset('storage/posts/' . $image->image_path) }}"

                    alt="post image"
                    class="w-full h-[35rem] object-cover object-center transition-opacity duration-700 ease-in-out
               {{ $index === 0 ? 'opacity-100 block' : 'opacity-0 hidden' }}"
                    data-image="{{ $index }}">
            </div>

            @endforeach


            {{-- أزرار + مؤشرات --}}
            <div class="flex flex-col items-center w-full py-3 gap-2">
                {{-- أزرار التنقل --}}
                <div class="flex justify-center gap-6">
                    <button class="bg-white/80 hover:bg-white text-gray-700 rounded-full px-4 py-1 shadow-md transition"
                        onclick="prevImage(this)">
                        ‹
                    </button>
                    <button class="bg-white/80 hover:bg-white text-gray-700 rounded-full px-4 py-1 shadow-md transition"
                        onclick="nextImage(this)">
                        ›
                    </button>
                </div>

                {{-- النقاط --}}
                <div class="flex gap-2" data-dots>
                    @foreach ($images as $index => $image)
                    <span class="w-2 h-2 rounded-full transition
                                     {{ $index === 0 ? 'bg-pink-600' : 'bg-gray-300' }}"
                        data-dot="{{ $index }}"></span>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="p-3">
            <a href="{{ route('post.show' , $post->slug) }}" class="font-bold">{{ $post->owner->username }}</a>
            {{ $post->caption }}
        </div>
        
        @if($post->comments->count() > 0)
        <a href="/post/{{ $post->slug }}" class="p-3 font-bold text-sm text-gray-500">
            {{ __("View All ") . $post->comments->count() . __(" Comments") }}
        </a>
        @endif
        <div class="p-3 text-gray-400 uppercase text-xs">
            {{ $post->created_at->diffForHumans() }}
        </div>
        <div class="card-footer border-t ">
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
                        class="flex-grow h-10 max-h-40 p-1 border-none focus:outline-none 
                       focus:ring-2 focus:ring-pink-300 text-gray-700 resize-none overflow-hidden leading-relaxed"
                        oninput="autoResize(this)"></textarea>

                    <button
                        class="px-4 py-1 rounded-lg bg-pink-500 text-white font-semibold hover:bg-pink-600 transition">
                        {{ __('Comment') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>