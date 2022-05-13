<?php

namespace App\Http\Controllers;

use App\Domains\LookupCategory;
use App\Models\Content;
use App\Models\LookupModel;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contents = LookupModel::with('lcontent')->getCategoryById(LookupCategory::CONTENT)->get();
        return view('contents.index_content', compact('contents'));
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
        $type = LookupModel::getCategoryById(LookupCategory::CONTENT)->where('lookup_value', $request->type)->firstOrFail();
        return view('contents.create_content', compact('type'));
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
            return redirect()->route('contents.index')->with('error', 'Sudah ada konten untuk type tersebut');
        }

        Content::create([
            'type' => 'mobile',
            'name' => $request->type,
            'content' => $request->content
        ]);

        return redirect()->route('contents.index')->with('success', 'Berhasil membuat konten');
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
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function edit(Content $content)
    {
        $content->load('header');
        return view('contents.edit_content', compact('content'));
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
