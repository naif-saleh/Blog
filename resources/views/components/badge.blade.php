@props(['category'])
<button {{ $attributes }} class="rounded-xl px-3 py-1 " style="background-color:{{ $category->bg_color }}; color:{{ $category->text_color }};">
    {{ $category->title }}</button>
