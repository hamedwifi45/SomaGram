<x-app-layout>
<div class="max-w-6xl mx-auto px-3 sm:px-0">
    <div class="flex flex-col lg:flex-row gap-8">
        {{-- Left Side (Posts) --}}
        <div class="flex-1 max-w-2xl mx-auto">
            @forelse($posts as $post)
                <x-post :post="$post" :images="$post->imagepost" />
            @empty
                <div class="max-w-xl mx-auto">
                    <p class="text-center text-gray-500">
                        {{ __("No posts yet. Follow users to see their posts.") }}
                    </p>
                </div>
            @endforelse
        </div>


        {{-- Right Side (Profile & Suggestions) --}}
        <div class="hidden lg:flex lg:flex-col w-80 pt-4">
            <div class="flex flex-row text-sm gap-3 items-center mb-6">
                <a href="">
                    <img src="{{ Auth::user()->image }}"
                         alt="{{ Auth::user()->username }}"
                         class="h-12 w-12 rounded-full object-cover border-2 border-pink-300 p-[2px]">
                </a>
                <div class="flex flex-col">
                    <a href="" class="font-bold hover:underline">
                        {{ auth()->user()->username }}
                    </a>
                    <div class="text-gray-400 text-sm">
                        {{ auth()->user()->name }}
                    </div>
                </div>
            </div>

            {{-- Example: Suggestions Box --}}
            <div class="bg-white rounded-2xl shadow-md p-4">
                <h2 class="font-semibold text-gray-700 mb-3">Suggestions for you</h2>
                <div class="flex flex-col gap-3">
                    @foreach ($sug_user as $sug)
                    
                    <div class="flex items-center gap-3">
                        <img src="{{ $sug->image }}"
                        class="h-10 w-10 rounded-full object-cover">
                        <div class="flex-1">
                            <p class="font-medium text-sm">{{ $sug->name }}</p>
                            <p class="text-xs text-gray-400">{{ $sug->username }}</p>
                        </div>
                        <a href="#" class="text-blue-500 text-sm font-semibold">Follow</a>
                    </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
</div>



    <script>
        // دالة لعرض صورة محددة في مجموعة صور (سلايدر)
        function showImage(postEl, index) {
            // الحصول على جميع عناصر الصور داخل المنشور
            const images = postEl.querySelectorAll('[data-image]');
            // الحصول على جميع نقاط التنقل (الدوائر) داخل المنشور
            const dots = postEl.querySelectorAll('[data-dot]');

            // تكرار على كل الصور وتطبيق Classes المناسبة
            images.forEach((img, i) => {
                // إضافة opacity-100 و block للصورة الحالية فقط (i === index)
                img.classList.toggle('opacity-100', i === index);
                img.classList.toggle('block', i === index);
                // إضافة opacity-0 و hidden للصور الأخرى (i !== index)
                img.classList.toggle('opacity-0', i !== index);
                img.classList.toggle('hidden', i !== index);
            });

            // تكرار على نقاط التنقل وتحديث مظهرها
            dots.forEach((dot, i) => {
                // جعل النقطة الحالية بلون pink-600
                dot.classList.toggle('bg-pink-600', i === index);
                // جعل النقاط الأخرى بلون gray-300
                dot.classList.toggle('bg-gray-300', i !== index);
            });

            // حفظ الفهرس الحالي في dataset للمنشور
            postEl.dataset.current = index;
        }

        // دالة للانتقال إلى الصورة التالية
        function nextImage(btn) {
            // العثور على عنصر المنشور الأقرب الذي يحتوي على الزر
            const postEl = btn.closest('[data-post]');
            // الحصول على جميع الصور في هذا المنشور
            const images = postEl.querySelectorAll('[data-image]');
            // قراءة الفهرس الحالي من dataset أو استخدام 0 كافتراضي
            let current = parseInt(postEl.dataset.current || 0);
            // حساب الفهرس الجديد مع الانتقال الدائري (عند الوصول لآخر صورة نعود للأولى)
            let newIndex = (current + 1) % images.length;
            // استدعاء دالة showImage لعرض الصورة الجديدة
            showImage(postEl, newIndex);
        }
        // function post(id){
        //     window.location.href = '/post/'+id;
        // }
        // // Event delegation في جزء منفصل من الـ
        // document.getElementById('images-container').addEventListener('click', function(e) {
        //     if (e.target.classList.contains('post-image')) {
        //         post(e.target.dataset.slug);
        //     }
        // });

        // دالة للانتقال إلى الصورة السابقة
        function prevImage(btn) {
            // العثور على عنصر المنشور الأقرب الذي يحتوي على الزر
            const postEl = btn.closest('[data-post]');
            // الحصول على جميع الصور في هذا المنشور
            const images = postEl.querySelectorAll('[data-image]');
            // قراءة الفهرس الحالي من dataset أو استخدام 0 كافتراضي
            let current = parseInt(postEl.dataset.current || 0);
            // حساب الفهرس الجديد مع الانتقال الدائري العكسي (عند الوصول لأول صورة ننتقل للأخيرة)
            let newIndex = (current - 1 + images.length) % images.length;
            // استدعاء دالة showImage لعرض الصورة الجديدة
            showImage(postEl, newIndex);
        }
    </script>

</x-app-layout>