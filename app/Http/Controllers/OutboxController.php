<?php

namespace App\Http\Controllers;

use App\Models\Outbox;
use Illuminate\Http\Request;

class OutboxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outboxes = Outbox::active()->get();
        return view('outbox.index_outbox', compact('outboxes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('outbox.create_outbox');
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
            'tgl_keluar' => 'required|date',
            'file' => 'sometimes|mimes:jpg,png,pdf|max:5120',
        ]);

        $insertData = [
            'nomor' => $request->nomor,
            'pengirim' => $request->pengirim,
            'penerima' => $request->penerima,
            'ringkasan' => $request->ringkasan,
            'tgl_surat' => $request->tgl_surat,
            'tgl_keluar' => $request->tgl_keluar,
            'keterangan' => $request->keterangan,
            'user_id' => auth()->id(),
        ];

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = 'outbox-' . uniqid() .'.'. $file->getClientOriginalExtension();
            $dirname = public_path() . '/outbox';
            if (!file_exists($dirname)) {
                mkdir($dirname, 755, true);
            }
            $filesave = $dirname . '/' . $filename;
            $file->move($dirname, $filename);
            $insertData['file'] = $filename;
        }

        try {
            Outbox::create($insertData);
            return redirect()->route('outboxes.index')->with('success', 'Berhasil menambahkan surat masuk');
        } catch (\Exception $ex) {
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
     * @param  \App\Models\Outbox  $outbox
     * @return \Illuminate\Http\Response
     */
    public function show(Outbox $outbox)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Outbox  $outbox
     * @return \Illuminate\Http\Response
     */
    public function edit(Outbox $outbox)
    {
        return view('outbox.edit_outbox', compact('outbox'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Outbox  $outbox
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outbox $outbox)
    {
        $request->validate([
            'nomor' => 'required',
            'pengirim' => 'required',
            'penerima' => 'required',
            'ringkasan' => 'required',
            'tgl_surat' => 'required|date',
            'tgl_keluar' => 'required|date',
            'file' => 'sometimes|mimes:jpg,png,pdf|max:5120',
        ]);

        $updateData = [
            'nomor' => $request->nomor,
            'pengirim' => $request->pengirim,
            'penerima' => $request->penerima,
            'ringkasan' => $request->ringkasan,
            'tgl_surat' => $request->tgl_surat,
            'tgl_keluar' => $request->tgl_keluar,
            'keterangan' => $request->keterangan,
        ];

        $dirname = public_path() . '/outbox';
        if (!file_exists($dirname)) {
            mkdir($dirname, 755, true);
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = 'outbox-' . uniqid() .'.'. $file->getClientOriginalExtension();
            $filesave = $dirname . '/' . $filename;
            $file->move($dirname, $filename);
            $updateData['file'] = $filename;
        }

        try {
            $outbox->update($updateData);
            $oldfile = $dirname . '/' . $outbox->file;
            if (file_exists($oldfile)) {
                unlink($oldfile);
            }   
            return redirect()->route('outboxes.index')->with('success', 'Update data berhasil');
        } catch (\Exception $ex) {
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
     * @param  \App\Models\Outbox  $outbox
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outbox $outbox)
    {
        $outbox->deactivate($outbox->id);

        return back()->with('success', 'Berhasil hapus surat masuk');
    }
}
