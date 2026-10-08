<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class categorycontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::withCount('MengambilBuku')->latest()->get();  // ⬅️ nama relasi benar
        return view('Kategori.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $Data=$request->validate([
            'Name'=>'required|max:100|unique:KATEGORI,Name',
            'Description'=>'nullable|string',
        ]);
        Kategori::create($Data);
        return redirect()->route('Category.index')->with('success','Berhasil yeeee');
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
    public function edit(Kategori $kategori)
    {
        return view('Kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
       $data=$request->validate([
        'Name'=>['required','max:100',Rule::unique('KATEGORI','Name')->ignore($kategori->id)],
        'Description'=>'nullable|string',
       ]);
       $kategori->update($data);
       return redirect()->route('Category.index')->with('success','Berhasil Horeee');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        if($kategori->MengambilBuku()->exists()){
            return redirect()->route('Category.index')->with('error','salah Masih ada buku ini');
        }
        $kategori->delete(); 
        return redirect()->route('Category.index')->with('success','Berhasil Yepeee');
    }
}
