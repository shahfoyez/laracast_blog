{{-- Dropdown --}}
<x-dropdown :categories='$categories'>
    {{-- Trigger --}}
    <x-slot name="trigger">
        <button
        class="py-2 pl-3 pr-9 text-sm font-semibold w-full lg:w-32 text-left flex lg:inline-flex"
    >
        {{  isset($CurrentCategory)? ucwords($CurrentCategory->name) : 'Categories' }}
        <x-icon name="down-arrow" class="absolute pointer-events-none" style="right: 12px;"/>
        {{-- <x-down-arrow class="absolute pointer-events-none" style="right: 12px;"/> --}}
        </button>
    </x-slot>
    {{-- Trigger End --}}

    <x-dropdown-item href="/?{{ http_build_query(request()->except('category', 'page')) }}" :active="request()->url('/') && !isset($CurrentCategory)">
        {{-- routeIs('home') if route has a name --}}
        All
    </x-dropdown-item>

    @foreach ($categories as $category)
    <x-dropdown-item
        {{-- http_build_query() convert array into string --}}
        href="?category={{ $category->slug}}&{{http_build_query(request()->except('category','page')) }}"
        {{-- :active='request()->is("categories/.{$category->slug}")' --}}
        :active="isset($CurrentCategory) && $CurrentCategory->is($category)"
    >
        {{ ucwords($category->name)  }}
    </x-dropdown-item>
    @endforeach
</x-dropdown>
{{-- Dropdown End --}}
