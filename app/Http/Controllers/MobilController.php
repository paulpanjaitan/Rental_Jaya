<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobil;

class MobilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mobils = Mobil::all(); // Ambil semua data mobil
        return view('mobil.index', compact('mobils'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mobil.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'merek' => 'required',
        'model' => 'required',
        'nopol' => 'required',
        'harga_per_hari' => 'required|numeric',
        'status' => 'required',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    $data = $request->all();

    if ($request->hasFile('gambar')) {
        $file = $request->file('gambar');
        $nama_gambar = time() . '.' . $file->getClientOriginalExtension();
        
        $destinationPath = public_path('uploads/mobil');
        if (!is_dir($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }
        $file->move($destinationPath, $nama_gambar);
        
        $data['gambar'] = $nama_gambar;
    }

    Mobil::create($data);
    return redirect()->route('mobil.index')->with('success', 'Data mobil berhasil ditambahkan.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mobil = Mobil::findOrFail($id); 
        return view('mobil.edit', compact('mobil'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
        'merek' => 'required',
        'model' => 'required',
        'nopol' => 'required|unique:mobils,nopol,' . $id,
        'harga_per_hari' => 'required|numeric',
        'status' => 'required|in:tersedia,disewa',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
     ]);

     $mobil = Mobil::findOrFail($id);
    
    
     if ($request->hasFile('gambar')) {
        
        if ($mobil->gambar && \Storage::exists('uploads/mobil/' . $mobil->gambar)) {
            \Storage::delete('uploads/mobil/' . $mobil->gambar);
        }
        
        // Upload gambar baru
        $file = $request->file('gambar');
        $nama_gambar = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('uploads/mobil', $nama_gambar);
        
        $mobil->gambar = $nama_gambar;
        }
    
     $mobil->update($request->only(['merek', 'model', 'nopol', 'harga_per_hari', 'status']));

         return redirect()->route('mobil.index')->with('success', 'Data mobil berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
           $mobil = Mobil::findOrFail($id);
    
    // Hapus file gambar
    if ($mobil->gambar && file_exists(public_path('uploads/mobil/' . $mobil->gambar))) {
        unlink(public_path('uploads/mobil/' . $mobil->gambar));
    }
    
    $mobil->delete();
    return redirect()->route('mobil.index')->with('success', 'Mobil berhasil dihapus!'); 
    }
}
