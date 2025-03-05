<?php

namespace App\Http\Controllers;

use App\Models\Armada;
use App\Models\TypeMobil;
use Illuminate\Http\Request;

class ArmadaController extends Controller
{

    public function list()
    {
        return datatables()
            ->eloquent(Armada::query()->latest())
            ->addColumn('action', function ($armada) {
                return '
                    <div class="d-flex">
                        <form onsubmit="destroy(event)" action="' . route('armada.destroy', $armada->id) . '" method="POST">
                            <input type="hidden" name="_token" value="' . @csrf_token() . '" enctype="multipart/form-data">
                            <a href="#" class="btn btn-sm btn-warning rounded mb-1" data-bs-toggle="modal" data-bs-target="#editArmadaModal' . $armada->id . '"><i class="fa fa-edit"></i></a>
                            <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-sm btn-danger mr-2 mb-1">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </form>
                    </div>
                ';
            })
            ->editColumn('typemobil_id', function ($armada) {
                return $armada->mobil->type_mobil;
            })
            ->editColumn('harga', function ($armada) {
                return '
                    <div class="text-center">
                        Rp' . number_format($armada->harga, 0, ',', '.') . '
                    </div
                ';
            })
            ->editColumn('plat_nomor', function ($armada) {
                return '
                    <div class="d-flex justify-content-center">
                        <span class="badge bg-secondary fs-5 p-2">
                            ' . $armada->plat_nomor . '
                        </span>
                    </div>
                ';
            })
            ->editColumn('status', function ($armada) {
                return $armada->status == 0
                    ? '<div class="text-center"><p class="p-2 px-3 fs-6 badge badge-success">Tersedia</p></div>'
                    : '<div class="text-center"><p class="p-2 px-3 fs-6 badge badge-danger">Disewa</p></div>';
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
        $typemobils = TypeMobil::where('jumlah', '>', 0)->get();
        $armadas = Armada::all();
        return view('dashboard.armada.index', compact(['typemobils', 'armadas']));
    }

    public function mobil()
    {
        $armadas = Armada::all();
        $typemobils = TypeMobil::all();
        return view('mobil', compact(['armadas', 'typemobils']));
    }

    public function filter(Request $request)
    {
        $query = Armada::query();
        $typemobils = TypeMobil::all();

        // Filter berdasarkan type_mobil
        if ($request->has('type_mobil')) {
            $typemobil = $request->input('type_mobil');
            $query->whereHas('mobil', function ($query) use ($typemobil) {
                $query->whereIn('type_mobil', $typemobil);
            });
        }

        // Filter berdasarkan bensin
        if ($request->has('bensin')) {
            $bensin = $request->input('bensin');
            $query->whereHas('mobil', function ($query) use ($bensin) {
                $query->whereIn('bensin', $bensin);
            });
        }

        // Eksekusi query
        $armadas = $query->get();

        return view('mobil', compact(['armadas', 'typemobils']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate Request //
        $data = $request->validate([
            'typemobil_id' => 'required|string',
            'nama_mobil' => 'required|string',
            'plat_nomor' => 'required|string',
            'status' => 'required',
            'harga' => 'required'
        ]);

        // Request mobilImages //
        if ($request->hasFile('mobilImages')) {
            $newImage = $request->mobilImages->getClientOriginalName();
            $request->mobilImages->storeAs('public/mobilImages', $newImage);
            $data['mobilImages'] = $newImage;
        }

        $typemobil = TypeMobil::findOrFail($request->typemobil_id);
        if ($typemobil->jumlah < 1) {
            return redirect('/dashboard/armada')->with('error', 'Jumlah kendaraan jenis ini tidak mencukupi.');
        }
        $typemobil->update([
            'jumlah' => $typemobil->jumlah - 1
        ]);

        $armada = Armada::create($data);

        return redirect('/dashboard/armada')->with('success', 'Armada Created Successfully');
    }

    public function update(Request $request, Armada $armada)
    {
        // Validate Request //
        $data = $request->validate([
            'typemobil_id' => 'required|string',
            'nama_mobil' => 'required|string',
            'plat_nomor' => 'required|string',
            'status' => 'required',
            'harga' => 'required'
        ]);

        if ($request->hasFile('mobilImages')) {
            $newImage = $request->mobilImages->getClientOriginalName();
            $request->mobilImages->storeAs('public/mobilImages', $newImage);
            $data['mobilImages'] = $newImage;
        }

        $findArmada = Armada::find($armada->id);
        $findArmada->update($data);

        return redirect('/dashboard/armada')->with('success', 'Armada Updated Successfully');
    }

    public function destroy(Armada $armada)
    {
        $armada->delete();

        return response()->json(['success' => 'Armada Deleted Successfully']);
    }
}
