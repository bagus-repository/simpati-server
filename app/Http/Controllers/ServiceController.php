<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\LookupModel;
use Illuminate\Http\Request;
use App\Domains\LookupCategory;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contents = LookupModel::with('lcontent')->getCategoryById(LookupCategory::FILLING)->get();
        return view('services.index_content', compact('contents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'type' => 'required'
        ]);
        $type = LookupModel::getCategoryById(LookupCategory::FILLING)->where('lookup_value', $request->type)->firstOrFail();
        return view('services.create_content', compact('type'));
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
            'type' => 'required',
            'content' => 'required'
        ]);

        if (Content::where('name', $request->type)->exists()) {
            return redirect()->route('services.index')->with('error', 'Sudah ada konten untuk type tersebut');
        }

        Content::create([
            'type' => 'mobile',
            'name' => $request->type,
            'content' => $request->content
        ]);

        return redirect()->route('services.index')->with('success', 'Berhasil membuat konten');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function show(Content $content)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Content  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Content $service)
    {
        $service->load('header');
        return view('services.edit_content', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Content $content)
    {
        $request->validate([
            'content' => 'required'
        ]);

        $content->update([
            'content' => $request->content
        ]);

        return back()->with('success', 'Berhasil update konten');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy(Content $content)
    {
        //
    }
}
