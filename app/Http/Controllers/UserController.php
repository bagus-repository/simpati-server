<?php

namespace App\Http\Controllers;

use App\Domains\LookupCategory;
use App\Models\LookupModel;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index_user', [
            'users' => User::active()->get(),
        ]);
    }

    public function create()
    {
        return view('user.create_user', [
            'roles' => LookupModel::getCategoryById(LookupCategory::ROLE)->get()
        ]);
    }

    public function edit($id)
    {
        return view('user.edit_user', [
            'user' => User::active()->findOrFail($id),
            'roles' => LookupModel::getCategoryById(LookupCategory::ROLE)->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->where(function($query) use ($request){
                    $query->where('email', $request->email);
                })
            ],
            'password' => 'required|min:6',
            'role' => 'required|in:admin,user'
        ]);
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => $request->role
            ]);

            return back()->with('success', 'Berhasil tambah user');
        } catch (Exception $ex) {
            return back()->with('error', $ex->getMessage());
        }        
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'nullable|min:6',
            'role' => 'required|in:admin,user'
        ]);
        try {
            $updateData = [
                'name' => $request->name,
                'role' => $request->role
            ];
            if ($request->filled('password')) {
                $updateData['password'] = bcrypt($request->password);
            }
            User::findOrFail($id)->update($updateData);

            return back()->with('success', 'Berhasil update user');
        } catch (Exception $ex) {
            return back()->with('error', $ex->getMessage());
        }

        
    }

    public function delete($id)
    {
        try {
            User::active()->where('id', $id)->deactivate();
    
            return back()->with('success', 'Berhasil delete user');
        } catch (Exception $ex) {
            return back()->with('error', $ex->getMessage());
        }
    }
}
