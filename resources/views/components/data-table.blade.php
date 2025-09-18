@props(['createRoute'])

<div class="relative overflow-x-auto shadow-md sm:rounded-lg p-6">
    <!-- Create Button -->
    <div class="mb-4 flex justify-end">
        <a href="{{ $createRoute }}" class="px-4 py-2 text-xs font-medium text-white bg-indigo-500 rounded hover:bg-indigo-600 focus:outline-none dark:bg-indigo-700 dark:hover:bg-indigo-800">
            Create
        </a>
    </div>

    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            {{ $thead }}
        </thead>
        <tbody>
            {{ $tbody }}
        </tbody>
    </table>
</div>
