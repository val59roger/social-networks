@props(['active', 'textColor' => 'text-gray-500'])

@php
$classes = ($active ?? false)
            ? "inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 $textColor focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out"
            : "inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 $textColor hover:bg-indigo-300 hover:text-black hover:border-gray-300 focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out";
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
