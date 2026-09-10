<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Court;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminCourtController extends Controller
{
    public function index()
    {
        $courts = Court::latest()->get();
        return view('admin.courts.index', compact('courts'));
    }

    public function create()
    {
        return view('admin.courts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'type'           => 'required|string|max:255',
            'price_per_hour' => 'required|numeric|min:0',
            'description'    => 'nullable|string',
            'image'          => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'status'         => 'required|in:available,maintenance',
        ]);

        $imagePath = $request->file('image')->store('courts', 'public');

        Court::create([
            'name'           => $request->name,
            'type'           => $request->type,
            'price_per_hour' => $request->price_per_hour,
            'description'    => $request->description,
            'image'          => $imagePath,
            'status'         => $request->status,
        ]);

        return redirect()->route('admin.courts.index')->with('success', 'Lapangan baru berhasil ditambahkan!');
    }

    public function edit(Court $court)
    {
        return view('admin.courts.edit', compact('court'));
    }

    public function update(Request $request, Court $court)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'type'           => 'required|string|max:255',
            'price_per_hour' => 'required|numeric|min:0',
            'description'    => 'nullable|string',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status'         => 'required|in:available,maintenance',
        ]);

        $data = [
            'name'           => $request->name,
            'type'           => $request->type,
            'price_per_hour' => $request->price_per_hour,
            'description'    => $request->description,
            'status'         => $request->status,
        ];

        if ($request->hasFile('image')) {
            if ($court->image && Storage::disk('public')->exists($court->image)) {
                Storage::disk('public')->delete($court->image);
            }
            $data['image'] = $request->file('image')->store('courts', 'public');
        }

        $court->update($data);

        return redirect()->route('admin.courts.index')->with('success', 'Data lapangan berhasil diperbarui!');
    }

    public function destroy(Court $court)
    {
        if ($court->image && Storage::disk('public')->exists($court->image)) {
            Storage::disk('public')->delete($court->image);
        }

        $court->delete();

        return redirect()->route('admin.courts.index')->with('success', 'Lapangan berhasil dihapus!');
    }
}