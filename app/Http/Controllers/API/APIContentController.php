<?php

namespace App\Http\Controllers\API;

use App\Models\LookupModel;
use App\Domains\APIResponse;
use Illuminate\Http\Request;
use App\Domains\LookupCategory;
use App\Http\Controllers\Controller;

class APIContentController extends Controller
{
    public function getContents()
    {
        $contents = LookupModel::with('lcontent')->getCategoryById(LookupCategory::CONTENT)->get();
        $rsp = new APIResponse();
        $rsp->data = $contents;
        return response()->json($rsp);
    }
}
