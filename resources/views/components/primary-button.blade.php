@props(['disabled' => false])

<button @disabled($disabled)
    {{ $attributes->merge(['type' => 'submit', 'class' => 'flex items-center px-4 py-3 bg-indigo-700 border border-transparent rounded-xl font-semibold text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 disabled:bg-indigo-300 disabled:hover:bg-indigo-300 disabled:cursor-not-allowed disabled:opacity-70']) }}>
    {{ $slot }}
</button>
