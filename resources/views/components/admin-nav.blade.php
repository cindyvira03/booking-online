<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    @foreach($menus as $menu)
        <x-nav-link :href="route($menu['route'])" :active="request()->routeIs($menu['route'])">
            {{ __($menu['label']) }}
        </x-nav-link>
    @endforeach
</div>