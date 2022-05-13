<?php

namespace App\Http\Controllers;

use App\Domains\LookupCategory;
use App\Models\Efilling;
use App\Models\LookupModel;
use Illuminate\Http\Request;

class EfillingController extends Controller
{
    public function index(Request $request)
    {
        $efilling = Efilling::with('filling_type', 'request_by', 'approval_by');
        $status = $request->status ?? 'all';
        if ($status != 'all') {
            $efilling->where('sts', $status);
        }
        return view('efilling.index_efilling', [
            'data' => $efilling->get(),
            'filterStatus' => $status,
            'filters' => LookupModel::getCategoryById(LookupCategory::FILTER_STATUS)->get(),
        ]);
    }

    public function approval(Request $request)
    {
        $request->validate([
            'service_no' => 'required',
            'sts' => 'required|in:0,1,2',
            'approval' => 'required|in:apv,rjt'
        ]);

        $efilling = Efilling::where('service_no', $request->service_no)->firstOrFail();

        if ($efilling->sts != $request->sts) {
            return back()->with('error', 'Data permohonan telah berubah');
        }

        $efilling->update([
            'sts' => $request->approval == 'apv' ? 1:2,
            'apvnote' => $request->apvnote,
            'apv_by' => auth()->id(),
            'apv_date' => now()
        ]);

        return back()->with('success', 'Berhasil approval');
    }
}
