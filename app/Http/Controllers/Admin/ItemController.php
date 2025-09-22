<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemImage;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ItemController extends Controller
{
    // Menampilkan semua item
    public function index()
    {
        $items = Item::active()->with('category')->latest()->get(); // ambil juga data category

        return view('item.index', compact('items'));
    }

    // Menampilkan form create item
    public function create()
    {
        $categories = Category::select('id', 'category_name')->get();
        // ambil kategori untuk select dropdown
        return view('item.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|unique:items,name',
            'price' => 'required|integer|min:0',
            'description' => 'required',
            'images' => 'required|array|max:5',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'category_id.required' => 'Kategori harus dipilih',
            'name.required' => 'Nama item harus diisi',
            'name.unique' => 'Nama item sudah digunakan',
            'price.required' => 'Harga harus diisi',
            'description.required' => 'Deskripsi harus diisi',
            'images.required' => 'Minimal 1 gambar harus diupload',
            'images.max' => 'Maksimal 5 gambar boleh diupload',
            'images.*.image' => 'File harus berupa gambar',
            'images.*.mimes' => 'Format gambar hanya boleh jpg, jpeg, atau png',
            'images.*.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        // simpan item dulu
        $item = Item::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug'        => Str::slug($request->name),
            'price' => $request->price,
            'description' => $request->description,
        ]);

        // simpan gambar ke tabel item_images
        if ($request->hasFile('images')) {
            $imagesData = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('item_images', 'public');
                $imagesData[] = ['image' => $path];
            }

            $item->images()->createMany($imagesData);
        }

        return redirect()->route('admin.items.index')
            ->with('success', 'Item berhasil ditambahkan');
    }

    public function show($id)
    {
        $item = Item::with(['category', 'images'])->findOrFail($id);

        return view('item.show', compact('item'));
    }


    // Menampilkan form edit
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $categories = Category::withCount('items')->select('id', 'category_name')->get();

        return view('item.edit', compact('item', 'categories'));
    }

    // Update item
    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|unique:items,name,' . $item->id,
            'price'       => 'required|integer|min:0',
            'description' => 'required',
        ], [
            'category_id.required' => 'Kategori harus dipilih',
            'category_id.exists'   => 'Kategori tidak valid',
            'name.required'        => 'Nama item harus diisi',
            'name.unique'          => 'Nama item sudah digunakan',
            'price.required'       => 'Harga harus diisi',
            'description.required' => 'Deskripsi harus diisi',
        ]);

        $item->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.items.index')->with('success', 'Item updated successfully.');
    }

    // Hapus item
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->update(['status' => 'nonactive']);

        return redirect()->route('admin.items.index')->with('success', 'Item deleted successfully.');
    }
}
