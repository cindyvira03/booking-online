<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Item') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="mb-4">Add Item</h1>

                    <form method="POST" action="{{ route('admin.items.store') }}" enctype="multipart/form-data">
                        @csrf

                        {{-- Images --}}
                        <div class="mb-4">
                            <label for="images" class="block text-sm font-medium text-gray-700">
                                Upload Images (max 5)
                            </label>
                            <input type="file" name="images[]" id="images" multiple
                                accept="image/*"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <p class="text-gray-500 text-sm mt-1">You can upload up to 5 images (jpg, jpeg, png, max 2MB each).</p>
                            @error('images')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            @error('images.*')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        {{-- Item Name --}}
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">
                                Item Name
                            </label>
                            <input type="text" name="name" id="name"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                   value="{{ old('name') }}">
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Category --}}
                        <div class="mb-4">
                            <label for="category_id" class="block text-sm font-medium text-gray-700">
                                Category
                            </label>
                            <select name="category_id" id="category_id" 
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">-- Select Category --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" 
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Price --}}
                        <div class="mb-4">
                            <label for="price" class="block text-sm font-medium text-gray-700">
                                Price
                            </label>
                            <input type="number" name="price" id="price" step="1"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                   value="{{ old('price') }}">
                            @error('price')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">
                                Description
                            </label>
                            <textarea name="description" id="description" rows="4"
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex space-x-2">
                            {{-- Save pakai komponen Jetstream --}}
                            <x-primary-button>
                                Save
                            </x-primary-button>

                            {{-- Cancel --}}
                            <a href="{{ route('admin.items.index') }}" 
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
