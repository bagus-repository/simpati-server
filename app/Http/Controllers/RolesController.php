<?php

namespace App\Http\Controllers;

use App\Models\LookupModel;
use Illuminate\Http\Request;
use App\Domains\LookupCategory;
use Illuminate\Validation\Rule;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->view('roles.index_role', [
            'roles' => LookupModel::getCategoryById(LookupCategory::ROLE)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('roles.create_role');
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
            'lookup_id' => [
                'required',
                Rule::unique('lookups', 'lookup_id')->where(function($query){
                    $query->where('category_id', LookupCategory::ROLE);
                })
            ],
            'lookup_value' => [
                'required',
                Rule::unique('lookups', 'lookup_value')->where(function($query){
                    $query->where('category_id', LookupCategory::ROLE);
                })
            ],
            'lookup_desc' => 'required',
        ]);

        try {
            LookupModel::create([
                'category_id' => LookupCategory::ROLE,
                'lookup_id' => $request->lookup_id,
                'lookup_value' => $request->lookup_value,
                'lookup_desc' => $request->lookup_desc,
                'sts' => 1,
            ]);

            return back()->with('success', 'Berhasil tambah role');
        } catch (\Exception $ex) {
            return back()->with('error', $ex->getMessage());
        }        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
