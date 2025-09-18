<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Item Detail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="mb-6 text-lg font-bold">Detail Item</h1>

                    <div class="space-y-4">
                        <div>
                            <span class="font-semibold">ID:</span>
                            <span>{{ $item->id }}</span>
                        </div>

                        <div>
                            <span class="font-semibold">Name:</span>
                            <span>{{ $item->name }}</span>
                        </div>

                        <div>
                            <span class="font-semibold">Category:</span>
                            <span>{{ $item->category->category_name ?? '-' }}</span>
                        </div>

                        <div>
                            <span class="font-semibold">Price:</span>
                            <span>Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                        </div>

                        <div>
                            <span class="font-semibold">Description:</span>
                            <p class="mt-1">{{ $item->description ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('admin.items.index') }}" 
                           class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                            Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
