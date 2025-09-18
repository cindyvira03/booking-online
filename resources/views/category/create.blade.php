<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="mb-4">Add Category</h1>

                    <form method="POST" action="{{ route('admin.categories.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="category_name" class="block text-sm font-medium text-gray-700">
                                Category Name
                            </label>
                            <input type="text" name="category_name" id="category_name"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                   value="{{ old('category_name') }}">
                            @error('category_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex space-x-2">
                            {{-- Save pakai komponen Jetstream --}}
                            <x-primary-button>
                                Save
                            </x-primary-button>

                            {{-- Cancel --}}
                            <a href="{{ route('admin.categories.index') }}" 
                               class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
