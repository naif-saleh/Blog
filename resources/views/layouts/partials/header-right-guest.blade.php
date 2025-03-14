<div class="flex space-x-5">
   <x-nav-link :href="route('login')" :active="request()->routeIs('login')" class="text-sm text-gray-500">
        {{__('Login')}}
    </x-nav-link>
    <x-nav-link :href="route('register')" :active="request()->routeIs('register')" class="text-sm text-gray-500">
        {{__('Register')}}
    </x-nav-link>
</div>