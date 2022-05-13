<?php

namespace App\Http\Controllers;

use App\Models\Efilling;
use Illuminate\Http\Request;

class EfillingController extends Controller
{
    public function index(Request $request)
    {
        $efilling = Efilling::with('filling_type', 'request_by', 'approval_by');
        if ($request->has('status')) {
            if ($request->status != 'all') {
                $efilling->where('sts', $request->status);
            }
        }
        return view('efilling.index_efilling', [
            'data' => $efilling->get()
        ]);
    }

    public function approval(Efilling $efilling, Request $request)
    {
        $request->validate([
            'approval' => 'required|in:apv,rjt'
        ]);

        $efilling->update([
            'sts' => $request->approval == 'apv' ? 1:2,
            'apvnote' => $request->apvnote,
            'apv_by' => auth()->id(),
            'apv_date' => now()
        ]);

        return back()->with('success', 'Berhasil approval');
    }
}
