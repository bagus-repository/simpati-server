<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = Slider::orderBy('updated_at', 'desc')->get();
        return view('sliders.index_slider', compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sliders.create_slider');
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
            'judul' => 'required',
            'file' => 'required|mimes:jpg|max:10240'
        ]);

        DB::beginTransaction();
        $file = $request->file('file');
        $filename = 'sliders-' . uniqid() .'.'. $file->getClientOriginalExtension();
        $dirname = public_path() . '/sliders';
        if (!file_exists($dirname)) {
            mkdir($dirname, 755, true);
        }
        $filesave = $dirname . '/' . $filename;
        try {
            $file->move($dirname, $filename);
            Slider::create([
                'judul' => $request->judul,
                'file' => $filename,
                'sts' => 1
            ]);
            DB::commit();
            return redirect()->route('slide.index')->with('success', 'Berhasil menambahkan slider');
        } catch (\Exception $ex) {
            if (file_exists($filesave)) {
                unlink($filesave);
            }
            DB::rollBack();
            return back()->with('error', $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slide
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slide)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slide
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slide)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slide
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slide)
    {
        $request->validate(['sts' => 'required']);
        $slide->update([
            'sts' => $request->sts
        ]);

        return back()->with('success', 'Berhasil ubah status slider');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slide
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slide)
    {
        $filePath = public_path() . '/sliders/' . $slide->file;
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        $slide->delete();

        return back()->with('success', 'Berhasil hapus slider');
    }
}
