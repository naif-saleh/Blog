<div>
    <div id="posts" class=" px-3 lg:px-7 py-6">
        <div class="flex justify-between items-center border-b border-gray-100">
            <div id="filter-selector" class="flex items-center space-x-4 font-light ">
                <button class="{{$this->sort === 'desc' ? 'text-gray-900 py-4 border-b border-gray-700':'text-gray-500'}} py-4" wire:click="sortBy('desc')">Latest</button>
                <button class="{{$this->sort === 'asc' ? 'text-gray-900 py-4 border-b border-gray-700':'text-gray-500'}} py-4" wire:click="sortBy('asc')">Oldest</button>
            </div>
        </div>

            @foreach ($posts as $post)
                <x-posts.post-item :post="$post" />
            @endforeach
        </div>

            <div class="my-3">{{ $posts->onEachSide(1)->links() }}</div>

    </div>
</div>