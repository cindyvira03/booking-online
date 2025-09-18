<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Success Message --}}
                    @if (session('success'))
                        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show"
                             class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800 relative transition-opacity duration-500">
                            <span>{{ session('success') }}</span>
                            <button @click="show = false" class="absolute top-2 right-2 text-green-700 hover:text-green-900">&times;</button>
                        </div>
                    @endif

                    {{-- Error Message --}}
                    @if (session('error'))
                        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show"
                             class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800 relative transition-opacity duration-500">
                            <span>{{ session('error') }}</span>
                            <button @click="show = false" class="absolute top-2 right-2 text-red-700 hover:text-red-900">&times;</button>
                        </div>
                    @endif

                    {{-- Data Table --}}
                    <x-data-table :createRoute="route('admin.categories.create')">
                        <x-slot:thead>
                            <tr>
                                <th scope="col" class="px-6 py-3 text-center">No</th>
                                <th scope="col" class="px-6 py-3 text-center">Category Name</th>
                                <th scope="col" class="px-6 py-3 text-center">Total Items</th>
                                <th scope="col" class="px-6 py-3 text-center">Action</th>
                            </tr>
                        </x-slot:thead>

                        <x-slot:tbody>
                            @forelse($categories as $category)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                        {{ $loop->iteration }}
                                    </th>

                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        {{ $category->category_name }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        {{ $category->items_count }}
                                    </td>

                                    {{-- Actions --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex justify-center space-x-2">
                                            {{-- Edit Button --}}
                                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="p-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:outline-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4 12.5-12.5z" />
                                                </svg>
                                            </a>

                                            {{-- Delete Button --}}
                                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-white bg-red-500 rounded-lg hover:bg-red-600 focus:outline-none">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center px-6 py-4">No categories found.</td>
                                </tr>
                            @endforelse
                        </x-slot:tbody>
                    </x-data-table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
