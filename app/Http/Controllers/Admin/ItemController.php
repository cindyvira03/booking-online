<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ItemController extends Controller
{
    // Menampilkan semua item
    public function index()
    {
        $items = Item::with('category')->latest()->get(); // ambil juga data category

        return view('item.index', compact('items'));
    }

    // Menampilkan form create item
    public function create()
    {
        $categories = Category::select('id', 'category_name')->get();
        // ambil kategori untuk select dropdown
        return view('item.create', compact('categories'));
    }

    // Simpan item baru
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|unique:items,name',
            'price' => 'required|integer|min:0',
            'description' => 'required',
        ], [
            'category_id.required' => 'Kategori harus dipilih',
            'name.required' => 'Nama item harus diisi',
            'name.unique' => 'Nama item sudah digunakan',
            'price.required' => 'Harga harus diisi',

        ]);

        Item::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.items.index')->with('success', 'Item created successfully.');
    }

    // Menampilkan detail item
    public function show($id)
    {
        $item = Item::with('category')->findOrFail($id);

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
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'description' => 'required|string',
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
        $item->delete();

        return redirect()->route('admin.items.index')->with('success', 'Item deleted successfully.');
    }
}
