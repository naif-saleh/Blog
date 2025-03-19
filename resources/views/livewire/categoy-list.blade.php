<div class="flex items-center flex-wrap gap-2 font-light ">
    @foreach ($categories as $category)
        <x-badge wire:navigate href="{{ route('blog.index', ['category' => $category->title]) }}" :category="$category"/>
    @endforeach
</div>
