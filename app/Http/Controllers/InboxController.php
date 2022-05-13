<?php

namespace App\Http\Controllers;

use App\Models\Classify;
use App\Models\Dispose;
use App\Models\Inbox;
use Exception;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inboxes = Inbox::active()->get();
        return view('inbox.index_inbox', compact('inboxes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inbox.create_inbox');
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
            'nomor' => 'required',
            'pengirim' => 'required',
            'penerima' => 'required',
            'ringkasan' => 'required',
            'tgl_surat' => 'required|date',
            'tgl_diterima' => 'required|date',
            'file' => 'sometimes|mimes:jpg,png,pdf|max:5120',
        ]);

        $insertData = [
            'nomor' => $request->nomor,
            'pengirim' => $request->pengirim,
            'penerima' => $request->penerima,
            'ringkasan' => $request->ringkasan,
            'tgl_surat' => $request->tgl_surat,
            'tgl_diterima' => $request->tgl_diterima,
            'keterangan' => $request->keterangan,
            'user_id' => auth()->id(),
        ];

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = 'inbox-' . uniqid() .'.'. $file->getClientOriginalExtension();
            $dirname = public_path() . '/inbox';
            if (!file_exists($dirname)) {
                mkdir($dirname, 755, true);
            }
            $filesave = $dirname . '/' . $filename;
            $file->move($dirname, $filename);
            $insertData['file'] = $filename;
        }

        try {
            Inbox::create($insertData);
            return redirect()->route('inboxes.index')->with('success', 'Berhasil menambahkan surat masuk');
        } catch (Exception $ex) {
            if (isset($filesave)) {
                if (file_exists($filesave)) {
                    unlink($filesave);
                }
            }
            return back()->with('error', $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inbox  $inbox
     * @return \Illuminate\Http\Response
     */
    public function show(Inbox $inbox)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inbox  $inbox
     * @return \Illuminate\Http\Response
     */
    public function edit(Inbox $inbox)
    {
        return view('inbox.edit_inbox', compact('inbox'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inbox  $inbox
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inbox $inbox)
    {
        $request->validate([
            'nomor' => 'required',
            'pengirim' => 'required',
            'penerima' => 'required',
            'ringkasan' => 'required',
            'tgl_surat' => 'required|date',
            'tgl_diterima' => 'required|date',
            'file' => 'sometimes|mimes:jpg,png,pdf|max:5120',
        ]);

        $updateData = [
            'nomor' => $request->nomor,
            'pengirim' => $request->pengirim,
            'penerima' => $request->penerima,
            'ringkasan' => $request->ringkasan,
            'tgl_surat' => $request->tgl_surat,
            'tgl_diterima' => $request->tgl_diterima,
            'keterangan' => $request->keterangan,
        ];

        $dirname = public_path() . '/inbox';
        if (!file_exists($dirname)) {
            mkdir($dirname, 755, true);
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = 'inbox-' . uniqid() .'.'. $file->getClientOriginalExtension();
            $filesave = $dirname . '/' . $filename;
            $file->move($dirname, $filename);
            $updateData['file'] = $filename;
        }

        try {
            $inbox->update($updateData);
            $oldfile = $dirname . '/' . $inbox->file;
            if (file_exists($oldfile)) {
                unlink($oldfile);
            }   
            return redirect()->route('inboxes.index')->with('success', 'Update data berhasil');
        } catch (Exception $ex) {
            if (isset($filesave)) {
                if (file_exists($filesave)) {
                    unlink($filesave);
                }
            }
            return back()->with('error', $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inbox  $inbox
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inbox $inbox)
    {
        $inbox->deactivate($inbox->id);

        return back()->with('success', 'Berhasil hapus surat masuk');
    }

    public function dispose(Inbox $inbox)
    {
        $inbox->load('disposes.classify');
        return view('inbox.index_dispose', compact('inbox'));
    }

    public function dispose_create(Inbox $inbox)
    {
        $classifies = Classify::active()->get();
        return view('inbox.create_dispose', compact('inbox', 'classifies'));
    }

    public function dispose_store(Inbox $inbox, Request $request)
    {
        $request->validate([
            'classifies_id' => 'required',
            'ringkasan' => 'required',
            'batas_waktu' => 'required|date',
        ]);

        $inbox->disposes()->create([
            'classifies_id' => $request->classifies_id,
            'inboxes_id' => $inbox->id,
            'ringkasan' => $request->ringkasan,
            'keterangan' => $request->keterangan,
            'batas_waktu' => $request->batas_waktu,
        ]);

        return back()->with('success', 'Berhasil buat disposisi');
    }

    public function dispose_edit(Inbox $inbox, Dispose $dispose)
    {
        $classifies = Classify::active()->get();
        return view('inbox.edit_dispose', compact('inbox', 'dispose', 'classifies'));
    }

    public function dispose_update(Dispose $dispose, Request $request)
    {
        $request->validate([
            'classifies_id' => 'required',
            'ringkasan' => 'required',
            'batas_waktu' => 'required|date',
        ]);

        $dispose->update([
            'classifies_id' => $request->classifies_id,
            'ringkasan' => $request->ringkasan,
            'keterangan' => $request->keterangan,
            'batas_waktu' => $request->batas_waktu,
        ]);

        return back()->with('success', 'Berhasil update disposisi');
    }

    public function dispose_destroy(Dispose $dispose)
    {
        $dispose->delete();

        return back()->with('success', 'Berhasil hapus disposisi');
    }
}
