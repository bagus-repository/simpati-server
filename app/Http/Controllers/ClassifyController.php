<?php

namespace App\Http\Controllers;

use App\Models\Classify;
use Illuminate\Http\Request;

class ClassifyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classifies = Classify::active()->get();
        return view('classify.index_classify', compact('classifies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('classify.create_classify');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required'
        ]);

        Classify::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
        ]);

        return redirect()->route('classifies.index')->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classify  $classify
     * @return \Illuminate\Http\Response
     */
    public function show(Classify $classify)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classify  $classify
     * @return \Illuminate\Http\Response
     */
    public function edit(Classify $classify)
    {
        return view('classify.edit_classify', compact('classify'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classify  $classify
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classify $classify)
    {
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required'
        ]);

        $classify->update([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
        ]);

        return redirect()->route('classifies.index')->with('success', 'Berhasil ubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classify  $classify
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classify $classify)
    {
        $classify->deactivate($classify->id);
        return redirect()->route('classifies.index')->with('success', 'Berhasil hapus data');
    }
}
