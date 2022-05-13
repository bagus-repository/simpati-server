<?php

namespace App\Http\Controllers;

use App\Models\NewsModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('news.index_news', [
            'news' => NewsModel::with('user')->active()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news.create_news', []);
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
            'title' => 'required',
            'desc' => 'required',
            'thumbnail' => 'required|mimes:jpg|max:512'
        ]);

        DB::beginTransaction();
        $file = $request->file('thumbnail');
        $filename = 'news-' . uniqid() .'.'. $file->getClientOriginalExtension();
        $dirname = public_path() . '/uploads';
        if (!file_exists($dirname)) {
            mkdir($dirname, 755, true);
        }
        $filesave = $dirname . '/' . $filename;
        try {
            $file->move($dirname, $filename);
            NewsModel::create([
                'title' => $request->title,
                'desc' => $request->desc,
                'image_url' => $filename,
                'created_by' => auth()->id()
            ]);
            DB::commit();
            return redirect()->route('news.index')->with('success', 'Berhasil menambahkan berita');
        } catch (Exception $ex) {
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
     * @param  \App\Models\NewsModel  $news
     * @return \Illuminate\Http\Response
     */
    public function show(NewsModel $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NewsModel  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(NewsModel $news)
    {
        return view('news.edit_news', [
            'news' => $news
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NewsModel  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NewsModel $news)
    {
        $request->validate([
            'title' => 'required',
            'desc' => 'required',
            'thumbnail' => 'sometimes|mimes:jpg|max:512'
        ]);

        DB::beginTransaction();
        $dirname = public_path() . '/uploads';
        $oldfile = $dirname . '/' . $news->image_url;
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = 'news-' . uniqid() .'.'. $file->getClientOriginalExtension();
            if (!file_exists($dirname)) {
                mkdir($dirname, 755, true);
            }
            $filesave = $dirname . '/' . $filename;
        }
        try {
            $updateData = [
                'title' => $request->title,
                'desc' => $request->desc,
            ];
            if ($request->hasFile('thumbnail')) {
                $updateData['image_url'] = $filename;
                $file->move($dirname, $filename);
            }
            $news->update($updateData);
            DB::commit();
            if ($request->hasFile('thumbnail')) {
                if (file_exists($oldfile)) {
                    unlink($oldfile);
                }
            }
            return redirect()->route('news.index')->with('success', 'Berhasil menambahkan berita');
        } catch (Exception $ex) {
            if ($request->hasFile('thumbnail')) {
                if (file_exists($filesave)) {
                    unlink($filesave);
                }
            }
            DB::rollBack();
            return back()->with('error', $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NewsModel  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(NewsModel $news)
    {
        try {
            $news->deactivate($news->id);
            return back()->with('success', 'Berhasil hapus berita');
        } catch (\Exception $ex) {
            return back()->with('error', $ex->getMessage());
        }
    }
}
