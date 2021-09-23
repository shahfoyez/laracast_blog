@props(['trigger'])
<div x-data="{ show:false }" @click.away=" show = false" >
    {{-- Trigger --}}
    <div @click=" show =!show ">
        {{ $trigger }}
    </div>
    {{-- Link --}}
    <div x-show="show" class="py-2 absolute bg-gray-200 mt-2 rounded-xl w-full z-50 overflow-auto max-h-40" style="display: none">
        {{ $slot }}
    </div>
</div>
