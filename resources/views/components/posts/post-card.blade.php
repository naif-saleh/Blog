@props(['posts'])
<div class="md:col-span-1 col-span-3">
    <a href="http://127.0.0.1:8000/blog/laravel-34">
        <div>
            <img class="w-full rounded-xl" src="{{ $posts->getImageUrlAttribute() }}">

        </div>
    </a>
    <div class="mt-3">
        <div class="flex items-center mb-2">
            @if($category = $posts->categories->first())
            <x-badge wire:navigate href="{{ route('blog.index', ['category' => $category->title]) }}" :category="$category"/>
            @endif
        
            <p class="text-gray-500 text-sm">{{$posts->published_at}}</p>
        </div>
        <a class="text-xl font-bold text-gray-900">{{$posts->title}}</a>
    </div>

</div>