<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('items')->get();

        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories,category_name',
        ], [
            'category_name.required' => 'Nama kategori harus diisi',
            'category_name.unique' => 'Nama kategori sudah digunakan',
        ]);


        Category::create([
            'category_name' => $request->category_name,
            'slug' => Str::slug($request->category_name),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('category.edit', compact('category'));
    }

    // Update category
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'category_name' => 'required|string|max:255|unique:categories,category_name,' . $category->id,
        ], [
            'category_name.required' => 'Category name is required',
            'category_name.unique' => 'Category name has already been taken',
        ]);


        $category->update([
            'category_name' => $request->category_name,
            'slug' => Str::slug($request->category_name),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    // Hapus category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
