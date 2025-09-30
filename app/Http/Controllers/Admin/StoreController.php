<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    /**
     * Form edit store
     */
    public function edit($id)
    {
        $store = Store::findOrFail($id);
        return view('store.edit', compact('store'));
    }

    /**
     * Update store
     */
    public function update(Request $request, $id)
    {
        $store = Store::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'address'     => 'required|string',
            'owner_name'  => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'name.required'       => 'Nama toko harus diisi',
            'address.required'    => 'Alamat toko harus diisi',
            'owner_name.required' => 'Nama pemilik harus diisi',
            'logo.image'          => 'Logo harus berupa gambar',
            'logo.mimes'          => 'Format logo hanya boleh jpg, jpeg, atau png',
        ]);

        // kalau ada upload logo baru
        if ($request->hasFile('logo')) {
            // hapus logo lama kalau ada
            if ($store->logo && Storage::disk('public')->exists($store->logo)) {
                Storage::disk('public')->delete($store->logo);
            }

            $path = $request->file('logo')->store('logos', 'public');

            $store->update([
                'name'        => $request->name,
                'address'     => $request->address,
                'owner_name'  => $request->owner_name,
                'description' => $request->description,
                'logo'        => $path ?? null,
            ]);
        }

        return redirect()->route('store.edit', $store->id)
            ->with('success', 'Store berhasil diperbarui.');
    }
}
