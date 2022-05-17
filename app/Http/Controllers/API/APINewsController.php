<?php

namespace App\Http\Controllers\API;

use App\Domains\APIResponse;
use App\Models\NewsModel;
use Illuminate\Http\Request;

class APINewsController
{
    public function GetNews(Request $request)
    {
        $rsp = new APIResponse();
        $rsp->data = NewsModel::active()->simplePaginate(7);
        return response()->json($rsp);
    }
}