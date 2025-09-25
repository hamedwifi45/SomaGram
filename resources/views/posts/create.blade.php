<x-app-layout>
    <div class="card p-10 w-full ">
        <h1 class="text-3xl mb-10">{{ __("Create a new post") }}</h1>

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

            <form action="{{ route('post.store') }}" enctype="multipart/form-data" class="w-full" method="post">
                @csrf
                <x-create-edit/>
                <x-primary-button class="mt-4">{{ __('Create Post') }}</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>