<?php

namespace App\Http\Controllers\API;

use App\Domains\APIResponse;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class APISliderController extends Controller
{
    public function getSliders()
    {
        $sliders = Slider::active()->orderBy('updated_at', 'desc')->get();
        $rsp = new APIResponse();
        $rsp->data = $sliders;
        return response()->json($rsp);
    }
}
