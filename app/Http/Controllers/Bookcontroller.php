<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;

class Bookcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $q = request('q');
        $buku = Buku::with('MengambilKategory')
            ->when($q, fn ($query) => $query->where('title', 'like', "%{$q}%")
                ->orWhere('author', 'like', "%{$q}%"))
            ->latest()
            ->get();

        return view('Buku.index', compact('buku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::orderBy('Name')->get(); 
        return view('Buku.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $Data=$request->validate([
            'category_id'=>'required|exists:KATEGORI,id',
            'title'=>'required|max:255',
            'author'=>'required|max:100',
            'published_year'=>'required|numeric',
            'stock'=>'required|integer|min:0',
        ]);
        Buku::create($Data);
        return redirect()->route('Book.index')->with('success','Berhasil Sip');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buku $buku)
    {
        $kategori = Kategori::orderBy('Name')->get();
        return view('Buku.edit', compact('buku', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Buku $buku)
    {
        $Data=$request->validate([
            'category_id'=>'required|exists:KATEGORI,id',
            'title'=>'required|max:255',
            'author'=>'required|max:100',
            'published_year'=>'required|numeric',
            'stock'=>'required|integer|min:0',
        ]);
           $buku->update($Data);
           return redirect()->route('Book.index')->with('success','Berhasil Oke');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buku $buku)
    {
        $buku->delete(); 
        return redirect()->route('Book.index')->with('success','Berhasil Mantapp');
    }
}
