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
        $sliders = Slider::active()->orderBy('updated_at', 'desc')->get();
        return view('sliders.index_slider', compact('sliders'));
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
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        $request->validate(['sts' => 'required']);
        $slider->update([
            'sts' => $request->sts
        ]);

        return back()->with('success', 'Berhasil ubah status slider');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $filePath = public_path() . '/sliders/' . $slider->file;
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        $slider->delete();

        return back()->with('success', 'Berhasil hapus slider');
    }
}
