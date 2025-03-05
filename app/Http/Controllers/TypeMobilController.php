<?php

namespace App\Http\Controllers;

use App\Models\TypeMobil;
use Illuminate\Http\Request;

class TypeMobilController extends Controller
{

    public function list()
    {
        return datatables()
            ->eloquent(TypeMobil::query()->latest())
            ->addColumn('action', function ($typemobil) {
                return '
                    <div class="d-flex">
                        <form onsubmit="destroy(event)" action="' . route('typemobil.destroy', $typemobil->id) . '" method="POST">
                            <input type="hidden" name="_token" value="' . @csrf_token() . '" enctype="multipart/form-data">
                            <a href="#" class="btn btn-sm btn-warning rounded mb-1" data-bs-toggle="modal" data-bs-target="#editMobilModal' . $typemobil->id . '"><i class="fa fa-edit"></i></a>
                            <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-sm btn-danger mr-2 mb-1">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </form>
                    </div>
                ';
            })
            ->addIndexColumn()
            ->escapeColumns(['action'])
            ->toJson();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $typemobils = TypeMobil::all();
        return view('dashboard.typemobil.index', compact('typemobils'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate Request //
        $data = $request->validate([
            'type_mobil' => 'required|string',
            'bensin' => 'required|string',
            'jumlah' => 'required'
        ]);

        $typemobil = TypeMobil::create($data);

        return redirect('/dashboard/typemobil')->with('success', 'Type Mobil Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(TypeMobil $typemobil)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TypeMobil $typemobil)
    {
        // Validate Request //
        $data = $request->validate([
            'type_mobil' => 'required|string',
            'bensin' => 'required|string',
            'jumlah' => 'required'
        ]);

        $findMobil = TypeMobil::find($typemobil->id);
        $findMobil->update($data);

        return redirect('/dashboard/typemobil')->with('success', 'Type Mobil Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TypeMobil $typemobil)
    {
        $typemobil->delete();

        return response()->json(['success' => 'Type Mobil Deleted Successfully']);
    }
}
