<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemImageController extends Controller
{
    public function store(Request $request, Item $item)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('image')->store('item_images', 'public');

        ItemImage::create([
            'item_id' => $item->id,
            'image' => $path,
        ]);

        return back()->with('success', 'Image added successfully.');
    }

    public function edit($id)
    {
        $image = ItemImage::findOrFail($id);
        return view('pages.admin.item_images.edit', compact('image'));
    }

    public function update(Request $request, $id)
    {
        $image = ItemImage::findOrFail($id);

        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // hapus gambar lama
        if ($image->image && Storage::disk('public')->exists($image->image)) {
            Storage::disk('public')->delete($image->image);
        }

        $path = $request->file('image')->store('item_images', 'public');

        $image->update([
            'image' => $path,
        ]);

        return redirect()->route('admin.items.show', $image->item_id)->with('success', 'Image updated successfully.');
    }

    public function destroy($id)
    {
        $image = ItemImage::findOrFail($id);

        if ($image->image && Storage::disk('public')->exists($image->image)) {
            Storage::disk('public')->delete($image->image);
        }

        $image->delete();

        return back()->with('success', 'Image deleted successfully.');
    }
}
