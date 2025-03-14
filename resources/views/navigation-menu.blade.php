<div class="flex items-center justify-between py-3 px-6 border-b border-gray-100">
    <div id="header-left" class="flex items-center">
        <x-application-logo />
        <div class="top-menu ml-10">
            <ul class="flex space-x-4">
                <li>
                   <x-nav-link wire:navigate :href="route('home')" :active="request()->routeIs('home')">
                        {{__('Home')}}
                    </x-nav-link>
                </li>

                <li>
                    <x-nav-link wire:navigate :href="route('blog.index')" :active="request()->routeIs('blog.index')" >
                        {{__('Blog')}}
                    </x-nav-link>
                </li>



            </ul>
        </div>
    </div>
    <div id="header-right" class="flex items-center md:space-x-6">
        @guest
            @include('layouts.partials.header-right-guest')
        @endguest
        @auth
            @include('layouts.partials.header-right-auth')
        @endauth
    </div>
</div>