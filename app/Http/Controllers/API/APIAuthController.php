<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Domains\APIResponse;
use App\Domains\LookupCategory;
use App\Models\LookupModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class APIAuthController
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device' => 'required',
        ]);

        $rsp = new APIResponse();
        $check = User::where('email', $request->email)->first();

        if (!$check) {
            $rsp->status = APIResponse::ERROR;
            $rsp->msg = 'Pengguna tidak ditemukan';

            return response()->json($rsp);
        }

        if (!password_verify($request->password, $check->password)) {
            $rsp->status = APIResponse::ERROR;
            $rsp->msg = 'Password salah';

            return response()->json($rsp);
        }

        Auth::loginUsingId($check->id);
        $token = auth()->user()->createToken($request->device);

        $rsp->data = [
            'id' => auth()->id(),
            'token' => $token->plainTextToken,
        ];
        return response()->json($rsp);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'user'
        ]);

        $rsp = new APIResponse();
        $rsp->data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ];

        return response()->json($rsp);
    }

    public function getVersion()
    {
        $versions = LookupModel::getCategoryById(LookupCategory::VERSION)->get();
        $rsp = new APIResponse();
        $rsp->data = [
            'min_android' => $versions->firstWhere('lookup_value', 'min_android')->lookup_desc ?? '1',
            'cur_android' => $versions->firstWhere('lookup_value', 'cur_android')->lookup_desc ?? '1',
            'store_url' => $versions->firstWhere('lookup_value', 'store_url')->lookup_desc ?? '',
        ];
        return response()->json($rsp);
    }

    public function getUser()
    {
        return response()->json(auth()->user());
    }
}