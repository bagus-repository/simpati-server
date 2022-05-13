<?php

namespace App\Http\Controllers\API;

use App\Domains\APIResponse;
use App\Models\LookupModel;
use App\Domains\LookupCategory;
use App\Models\Efilling;
use Illuminate\Http\Request;

class APIEfillingController
{
    public function GetServiceList()
    {
        $items = LookupModel::with('lcontent')->getCategoryById(LookupCategory::FILLING)->get();
        $rsp = new APIResponse();
        $rsp->data = $items;
        return response()->json($rsp);
    }

    public function SubmitEfilling(Request $request)
    {
        $request->validate([
            'service_code' => 'required',
            'file' => 'required|file|mimes:pdf,rar,zip|max:10240'
        ]);

        $user = auth()->user();
        $dirname = public_path() . "/efilling/" . $request->service_code;
        if (!file_exists($dirname)) {
            mkdir($dirname, 755, true);
        }
        $file = $request->file('file');
        $filename = 'efill' . $user->id . '-' . uniqid() .'.'. $file->getClientOriginalExtension();
        $file->move($dirname, $filename);

        Efilling::create([
            'service_no' => Efilling::getNextPK(),
            'requestor' => $user->id,
            'created_date' => now(),
            'service_code' => $request->service_code,
            'file' => $filename,
            'sts' => 0
        ]);

        $rsp = new APIResponse();
        $rsp->msg = 'Berhasil submit E-filling, silahkan menunggu verifikasi admin';

        return response()->json($rsp);
    }

    public function GetPermohonan()
    {
        $items = Efilling::with('filling_type', 'request_by', 'approval_by')->where('requestor', auth()->id())->get();
        $rsp = new APIResponse();
        $rsp->data = $items;

        return response()->json($rsp);
    }
}