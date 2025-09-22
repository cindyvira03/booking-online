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
                        <div class="mt-6">
                            <span class="font-semibold">Images:</span>

                            @if ($item->images->count() > 0)
                                <div id="itemCarousel" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach ($item->images as $key => $image)
                                            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                                <img src="{{ asset('storage/' . $image->image) }}" class="d-block w-100 rounded mb-2"
                                                    alt="Item Image {{ $key+1 }}">

                                                {{-- Tombol aksi --}}
                                                <div class="d-flex justify-content-center mt-2">
                                                    {{-- <a href="{{ route('admin.items.edit', $item->id) }}" 
                                                    class="btn btn-sm btn-warning me-2">Edit</a> --}}

                                                    <form method="POST" action="{{ route('admin.item-images.destroy', $image->id) }}" 
                                                        onsubmit="return confirm('Yakin hapus gambar ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    {{-- Navigasi Carousel --}}
                                    <button class="carousel-control-prev" type="button" data-bs-target="#itemCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon"></span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#itemCarousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon"></span>
                                    </button>
                                </div>
                            @endif

                        </div>
                        <div class="mt-4">
                                <form action="{{ route('admin.item-images.store', $item->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-2">
                                        <input type="file" name="image" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">Tambah Gambar</button>
                                </form>
                            </div>
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
