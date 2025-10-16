@props(['disabled' => false])

<textarea @disabled($disabled)
    {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm py-3 px-4']) }}>{{ $slot }}</textarea>
