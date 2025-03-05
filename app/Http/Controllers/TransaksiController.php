<?php

namespace App\Http\Controllers;

use App\Models\Armada;
use App\Models\Bayar;
use App\Models\Supir;
use App\Models\Transaksi;
use App\Models\TypeMobil;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksis = Transaksi::latest()->get();
        $bayars = Bayar::latest()->get();
        return view('transaksi.index', compact(['transaksis', 'bayars']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id, Supir $supir)
    {
        $armada = Armada::findOrFail($id);
        $supirs = Supir::all();
        return view('transaksi.bayar', compact(['armada', 'supirs']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $armadaId)
    {
        $armada = Armada::findOrFail($armadaId);

        // Validate Request //
        $data = $request->validate([
            'tipe_peminjaman' => 'required|string',
            'waktu' => 'required|integer',
            'tanggal' => 'required',
            'harga' => 'required',
        ]);
        $data['user_id'] = auth()->user()->id;
        $data['armada_id'] = $armadaId;
        $data['supir_id'] = $request->supir_id;
        $data['nama'] = auth()->user()->name;

        $transaksi = Transaksi::create($data);

        $findArmada = Armada::find($armada->id);
        $findArmada->update([
            'status' => 1
        ]);

        return redirect('/transaksi')->with('success', 'Berhasil dipesan, Silahkan lakukan pembayaran!');
    }

    // Semua Transaksi
    public function semua()
    {
        $transaksis = Transaksi::latest()->get();
        return view('dashboard.transaksi.semua', compact('transaksis'));
    }
    public function semualist()
    {
        return datatables()
            ->eloquent(Transaksi::query()->latest())
            ->addColumn('action', function ($transaksi) {
                $button = '';
                if ($transaksi->status == 1) {
                    $button .= '
                        <form action="' . route('bayar.setuju', $transaksi) . '" method="POST">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="' . csrf_token() . '" enctype="multipart/form-data">
                            <button class="btn btn-sm btn-success px-3 mr-2 mb-1">
                                <i class="fa fa-clipboard-check"></i>
                            </button>
                        </form>
                    ';
                } else if ($transaksi->status == 2) {
                    $button .= '
                        <form action="' . route('bayar.selesai', $transaksi) . '" method="POST">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="' . csrf_token() . '" enctype="multipart/form-data">
                            <button class="btn btn-sm btn-primary px-3 mr-2 mb-1">
                                <i class="fa fa-check"></i>
                            </button>
                        </form>
                    ';
                }
                if ($transaksi->status != 3 && $transaksi->status != 4) {
                    $button .= '
                        <form action="' . route('bayar.cancel', $transaksi) . '" method="POST">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="' . csrf_token() . '" enctype="multipart/form-data">
                            <button class="btn btn-sm btn-danger mr-2 mb-1">
                                <i class="fa fa-ban"></i>
                            </button>
                        </form>
                    ';
                }
                return '<div class="d-flex justify-content-center">' . $button . '</div>';
            })
            ->editColumn('armada', function ($transaksi) {
                return $transaksi->armada->mobil->type_mobil;
            })
            ->editColumn('plat_nomor', function ($transaksi) {
                return $transaksi->armada->plat_nomor;
            })
            ->editColumn('waktu', function ($transaksi) {
                return "$transaksi->waktu Hari";
            })
            ->editColumn('bukti_transfer', function ($transaksi) {
                if ($transaksi->bayar_id) {
                    return '
                        <div class="d-flex justify-content-center">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#buktiTransferModal' . $transaksi->id . '" class="buktiTransfer">
                                <img src="' . asset('storage/bukti_transfer/' . $transaksi->bayar->bukti_transfer) . '" width="50" alt="">
                            </a>
                        </div>
                    ';
                } else {
                    return '
                        <div class="d-flex justify-content-center">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#buktiTransferModal' . $transaksi->id . '" class="buktiTransfer">
                                <img src="' . asset('img/empty-bukti_transfer.jpg') . '" width="50" alt="">
                            </a>
                        </div>
                    ';
                }
            })
            ->editColumn('status', function ($transaksi) {
                return $transaksi->status == 0 ? '<div class="text-center"><p class="p-2 px-3 badge bg-secondary">Belum Bayar</p></div>'
                    : ($transaksi->status == 1 ? '<div class="text-center"><p class="p-2 px-3 badge bg-warning">Belum Disetujui</p></div>'
                        : ($transaksi->status == 2 ? '<div class="text-center"><p class="p-2 px-3 badge bg-success">Sedang Beroperasi</p></div>'
                            : ($transaksi->status == 3 ? '<div class="text-center"><p class="p-2 px-3 badge bg-primary">Selesai</p></div>'
                                : '<div class="text-center"><p class="p-2 px-3 badge bg-danger">Dibatalkan</p></div>')));
            })
            ->addIndexColumn()
            ->escapeColumns(['action'])
            ->toJson();
    }

    // Belum Bayar
    public function belumBayar()
    {
        $transaksis = Transaksi::latest()->get();
        return view('dashboard.transaksi.belumBayar', compact('transaksis'));
    }
    public function belumBayarlist()
    {
        return datatables()
            ->eloquent(Transaksi::query()->where('status', 0)->latest())
            ->addColumn('action', function ($transaksi) {
                $button = '';
                if ($transaksi->status == 1) {
                    $button .= '
                        <form action="' . route('bayar.setuju', $transaksi) . '" method="POST">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="' . csrf_token() . '" enctype="multipart/form-data">
                            <button class="btn btn-sm btn-success px-3 mr-2 mb-1">
                                <i class="fa fa-clipboard-check"></i>
                            </button>
                        </form>
                    ';
                } else if ($transaksi->status == 2) {
                    $button .= '
                        <form action="' . route('bayar.selesai', $transaksi) . '" method="POST">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="' . csrf_token() . '" enctype="multipart/form-data">
                            <button class="btn btn-sm btn-primary px-3 mr-2 mb-1">
                                <i class="fa fa-check"></i>
                            </button>
                        </form>
                    ';
                }
                if ($transaksi->status != 3 && $transaksi->status != 4) {
                    $button .= '
                        <form action="' . route('bayar.cancel', $transaksi) . '" method="POST">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="' . csrf_token() . '" enctype="multipart/form-data">
                            <button class="btn btn-sm btn-danger mr-2 mb-1">
                                <i class="fa fa-ban"></i>
                            </button>
                        </form>
                    ';
                }
                return '<div class="d-flex justify-content-center">' . $button . '</div>';
            })
            ->editColumn('armada', function ($transaksi) {
                return $transaksi->armada->mobil->type_mobil;
            })
            ->editColumn('plat_nomor', function ($transaksi) {
                return $transaksi->armada->plat_nomor;
            })
            ->editColumn('waktu', function ($transaksi) {
                return "$transaksi->waktu Hari";
            })
            ->editColumn('bukti_transfer', function ($transaksi) {
                if ($transaksi->bayar_id) {
                    return '
                        <div class="d-flex justify-content-center">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#buktiTransferModal' . $transaksi->id . '" class="buktiTransfer">
                                <img src="' . asset('storage/bukti_transfer/' . $transaksi->bayar->bukti_transfer) . '" width="50" alt="">
                            </a>
                        </div>
                    ';
                } else {
                    return '
                        <div class="d-flex justify-content-center">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#buktiTransferModal' . $transaksi->id . '" class="buktiTransfer">
                                <img src="' . asset('img/empty-bukti_transfer.jpg') . '" width="50" alt="">
                            </a>
                        </div>
                    ';
                }
            })
            ->editColumn('status', function ($transaksi) {
                return $transaksi->status == 0 ? '<div class="text-center"><p class="p-2 px-3 badge bg-secondary">Belum Bayar</p></div>'
                    : ($transaksi->status == 1 ? '<div class="text-center"><p class="p-2 px-3 badge bg-warning">Belum Disetujui</p></div>'
                        : ($transaksi->status == 2 ? '<div class="text-center"><p class="p-2 px-3 badge bg-success">Sedang Beroperasi</p></div>'
                            : ($transaksi->status == 3 ? '<div class="text-center"><p class="p-2 px-3 badge bg-primary">Selesai</p></div>'
                                : '<div class="text-center"><p class="p-2 px-3 badge bg-danger">Dibatalkan</p></div>')));
            })
            ->addIndexColumn()
            ->escapeColumns(['action'])
            ->toJson();
    }

    // Belum Setuju
    public function belumSetuju()
    {
        $transaksis = Transaksi::latest()->get();
        return view('dashboard.transaksi.belumSetuju', compact('transaksis'));
    }
    public function belumSetujulist()
    {
        return datatables()
            ->eloquent(Transaksi::query()->where('status', 1)->latest())
            ->addColumn('action', function ($transaksi) {
                $button = '';
                if ($transaksi->status == 1) {
                    $button .= '
                        <form action="' . route('bayar.setuju', $transaksi) . '" method="POST">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="' . csrf_token() . '" enctype="multipart/form-data">
                            <button class="btn btn-sm btn-success px-3 mr-2 mb-1">
                                <i class="fa fa-clipboard-check"></i>
                            </button>
                        </form>
                    ';
                } else if ($transaksi->status == 2) {
                    $button .= '
                        <form action="' . route('bayar.selesai', $transaksi) . '" method="POST">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="' . csrf_token() . '" enctype="multipart/form-data">
                            <button class="btn btn-sm btn-primary px-3 mr-2 mb-1">
                                <i class="fa fa-check"></i>
                            </button>
                        </form>
                    ';
                }
                if ($transaksi->status != 3 && $transaksi->status != 4) {
                    $button .= '
                        <form action="' . route('bayar.cancel', $transaksi) . '" method="POST">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="' . csrf_token() . '" enctype="multipart/form-data">
                            <button class="btn btn-sm btn-danger mr-2 mb-1">
                                <i class="fa fa-ban"></i>
                            </button>
                        </form>
                    ';
                }
                return '<div class="d-flex justify-content-center">' . $button . '</div>';
            })
            ->editColumn('armada', function ($transaksi) {
                return $transaksi->armada->mobil->type_mobil;
            })
            ->editColumn('plat_nomor', function ($transaksi) {
                return $transaksi->armada->plat_nomor;
            })
            ->editColumn('waktu', function ($transaksi) {
                return "$transaksi->waktu Hari";
            })
            ->editColumn('bukti_transfer', function ($transaksi) {
                if ($transaksi->bayar_id) {
                    return '
                        <div class="d-flex justify-content-center">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#buktiTransferModal' . $transaksi->id . '" class="buktiTransfer">
                                <img src="' . asset('storage/bukti_transfer/' . $transaksi->bayar->bukti_transfer) . '" width="50" alt="">
                            </a>
                        </div>
                    ';
                } else {
                    return '
                        <div class="d-flex justify-content-center">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#buktiTransferModal' . $transaksi->id . '" class="buktiTransfer">
                                <img src="' . asset('img/empty-bukti_transfer.jpg') . '" width="50" alt="">
                            </a>
                        </div>
                    ';
                }
            })
            ->editColumn('status', function ($transaksi) {
                return $transaksi->status == 0 ? '<div class="text-center"><p class="p-2 px-3 badge bg-secondary">Belum Bayar</p></div>'
                    : ($transaksi->status == 1 ? '<div class="text-center"><p class="p-2 px-3 badge bg-warning">Belum Disetujui</p></div>'
                        : ($transaksi->status == 2 ? '<div class="text-center"><p class="p-2 px-3 badge bg-success">Sedang Beroperasi</p></div>'
                            : ($transaksi->status == 3 ? '<div class="text-center"><p class="p-2 px-3 badge bg-primary">Selesai</p></div>'
                                : '<div class="text-center"><p class="p-2 px-3 badge bg-danger">Dibatalkan</p></div>')));
            })
            ->addIndexColumn()
            ->escapeColumns(['action'])
            ->toJson();
    }

    // Sedang Beroperasi
    public function sedangBeroperasi()
    {
        $transaksis = Transaksi::latest()->get();
        return view('dashboard.transaksi.sedangBeroperasi', compact('transaksis'));
    }
    public function sedangBeroperasilist()
    {
        return datatables()
            ->eloquent(Transaksi::query()->where('status', 2)->latest())
            ->addColumn('action', function ($transaksi) {
                $button = '';
                if ($transaksi->status == 1) {
                    $button .= '
                        <form action="' . route('bayar.setuju', $transaksi) . '" method="POST">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="' . csrf_token() . '" enctype="multipart/form-data">
                            <button class="btn btn-sm btn-success px-3 mr-2 mb-1">
                                <i class="fa fa-clipboard-check"></i>
                            </button>
                        </form>
                    ';
                } else if ($transaksi->status == 2) {
                    $button .= '
                        <form action="' . route('bayar.selesai', $transaksi) . '" method="POST">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="' . csrf_token() . '" enctype="multipart/form-data">
                            <button class="btn btn-sm btn-primary px-3 mr-2 mb-1">
                                <i class="fa fa-check"></i>
                            </button>
                        </form>
                    ';
                }
                if ($transaksi->status != 3 && $transaksi->status != 4) {
                    $button .= '
                        <form action="' . route('bayar.cancel', $transaksi) . '" method="POST">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="' . csrf_token() . '" enctype="multipart/form-data">
                            <button class="btn btn-sm btn-danger mr-2 mb-1">
                                <i class="fa fa-ban"></i>
                            </button>
                        </form>
                    ';
                }
                return '<div class="d-flex justify-content-center">' . $button . '</div>';
            })
            ->editColumn('armada', function ($transaksi) {
                return $transaksi->armada->mobil->type_mobil;
            })
            ->editColumn('plat_nomor', function ($transaksi) {
                return $transaksi->armada->plat_nomor;
            })
            ->editColumn('waktu', function ($transaksi) {
                return "$transaksi->waktu Hari";
            })
            ->editColumn('bukti_transfer', function ($transaksi) {
                if ($transaksi->bayar_id) {
                    return '
                        <div class="d-flex justify-content-center">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#buktiTransferModal' . $transaksi->id . '" class="buktiTransfer">
                                <img src="' . asset('storage/bukti_transfer/' . $transaksi->bayar->bukti_transfer) . '" width="50" alt="">
                            </a>
                        </div>
                    ';
                } else {
                    return '
                        <div class="d-flex justify-content-center">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#buktiTransferModal' . $transaksi->id . '" class="buktiTransfer">
                                <img src="' . asset('img/empty-bukti_transfer.jpg') . '" width="50" alt="">
                            </a>
                        </div>
                    ';
                }
            })
            ->editColumn('status', function ($transaksi) {
                return $transaksi->status == 0 ? '<div class="text-center"><p class="p-2 px-3 badge bg-secondary">Belum Bayar</p></div>'
                    : ($transaksi->status == 1 ? '<div class="text-center"><p class="p-2 px-3 badge bg-warning">Belum Disetujui</p></div>'
                        : ($transaksi->status == 2 ? '<div class="text-center"><p class="p-2 px-3 badge bg-success">Sedang Beroperasi</p></div>'
                            : ($transaksi->status == 3 ? '<div class="text-center"><p class="p-2 px-3 badge bg-primary">Selesai</p></div>'
                                : '<div class="text-center"><p class="p-2 px-3 badge bg-danger">Dibatalkan</p></div>')));
            })
            ->addIndexColumn()
            ->escapeColumns(['action'])
            ->toJson();
    }

    // Selesai
    public function selesai()
    {
        $transaksis = Transaksi::latest()->get();
        return view('dashboard.transaksi.selesai', compact('transaksis'));
    }
    public function selesailist()
    {
        return datatables()
            ->eloquent(Transaksi::query()->where('status', 3)->latest())
            ->addColumn('action', function ($transaksi) {
                $button = '';
                if ($transaksi->status == 1) {
                    $button .= '
                        <form action="' . route('bayar.setuju', $transaksi) . '" method="POST">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="' . csrf_token() . '" enctype="multipart/form-data">
                            <button class="btn btn-sm btn-success px-3 mr-2 mb-1">
                                <i class="fa fa-clipboard-check"></i>
                            </button>
                        </form>
                    ';
                } else if ($transaksi->status == 2) {
                    $button .= '
                        <form action="' . route('bayar.selesai', $transaksi) . '" method="POST">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="' . csrf_token() . '" enctype="multipart/form-data">
                            <button class="btn btn-sm btn-primary px-3 mr-2 mb-1">
                                <i class="fa fa-check"></i>
                            </button>
                        </form>
                    ';
                }
                if ($transaksi->status != 3 && $transaksi->status != 4) {
                    $button .= '
                        <form action="' . route('bayar.cancel', $transaksi) . '" method="POST">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="' . csrf_token() . '" enctype="multipart/form-data">
                            <button class="btn btn-sm btn-danger mr-2 mb-1">
                                <i class="fa fa-ban"></i>
                            </button>
                        </form>
                    ';
                }
                return '<div class="d-flex justify-content-center">' . $button . '</div>';
            })
            ->editColumn('armada', function ($transaksi) {
                return $transaksi->armada->mobil->type_mobil;
            })
            ->editColumn('plat_nomor', function ($transaksi) {
                return $transaksi->armada->plat_nomor;
            })
            ->editColumn('waktu', function ($transaksi) {
                return "$transaksi->waktu Hari";
            })
            ->editColumn('bukti_transfer', function ($transaksi) {
                if ($transaksi->bayar_id) {
                    return '
                        <div class="d-flex justify-content-center">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#buktiTransferModal' . $transaksi->id . '" class="buktiTransfer">
                                <img src="' . asset('storage/bukti_transfer/' . $transaksi->bayar->bukti_transfer) . '" width="50" alt="">
                            </a>
                        </div>
                    ';
                } else {
                    return '
                        <div class="d-flex justify-content-center">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#buktiTransferModal' . $transaksi->id . '" class="buktiTransfer">
                                <img src="' . asset('img/empty-bukti_transfer.jpg') . '" width="50" alt="">
                            </a>
                        </div>
                    ';
                }
            })
            ->editColumn('status', function ($transaksi) {
                return $transaksi->status == 0 ? '<div class="text-center"><p class="p-2 px-3 badge bg-secondary">Belum Bayar</p></div>'
                    : ($transaksi->status == 1 ? '<div class="text-center"><p class="p-2 px-3 badge bg-warning">Belum Disetujui</p></div>'
                        : ($transaksi->status == 2 ? '<div class="text-center"><p class="p-2 px-3 badge bg-success">Sedang Beroperasi</p></div>'
                            : ($transaksi->status == 3 ? '<div class="text-center"><p class="p-2 px-3 badge bg-primary">Selesai</p></div>'
                                : '<div class="text-center"><p class="p-2 px-3 badge bg-danger">Dibatalkan</p></div>')));
            })
            ->addIndexColumn()
            ->escapeColumns(['action'])
            ->toJson();
    }

    // Batal
    public function batal()
    {
        $transaksis = Transaksi::latest()->get();
        return view('dashboard.transaksi.batal', compact('transaksis'));
    }
    public function batallist()
    {
        return datatables()
            ->eloquent(Transaksi::query()->where('status', 4)->latest())
            ->addColumn('action', function ($transaksi) {
                $button = '';
                if ($transaksi->status == 1) {
                    $button .= '
                        <form action="' . route('bayar.setuju', $transaksi) . '" method="POST">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="' . csrf_token() . '" enctype="multipart/form-data">
                            <button class="btn btn-sm btn-success px-3 mr-2 mb-1">
                                <i class="fa fa-clipboard-check"></i>
                            </button>
                        </form>
                    ';
                } else if ($transaksi->status == 2) {
                    $button .= '
                        <form action="' . route('bayar.selesai', $transaksi) . '" method="POST">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="' . csrf_token() . '" enctype="multipart/form-data">
                            <button class="btn btn-sm btn-primary px-3 mr-2 mb-1">
                                <i class="fa fa-check"></i>
                            </button>
                        </form>
                    ';
                }
                if ($transaksi->status != 3 && $transaksi->status != 4) {
                    $button .= '
                        <form action="' . route('bayar.cancel', $transaksi) . '" method="POST">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="' . csrf_token() . '" enctype="multipart/form-data">
                            <button class="btn btn-sm btn-danger mr-2 mb-1">
                                <i class="fa fa-ban"></i>
                            </button>
                        </form>
                    ';
                }
                return '<div class="d-flex justify-content-center">' . $button . '</div>';
            })
            ->editColumn('armada', function ($transaksi) {
                return $transaksi->armada->mobil->type_mobil;
            })
            ->editColumn('plat_nomor', function ($transaksi) {
                return $transaksi->armada->plat_nomor;
            })
            ->editColumn('waktu', function ($transaksi) {
                return "$transaksi->waktu Hari";
            })
            ->editColumn('bukti_transfer', function ($transaksi) {
                if ($transaksi->bayar_id) {
                    return '
                        <div class="d-flex justify-content-center">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#buktiTransferModal' . $transaksi->id . '" class="buktiTransfer">
                                <img src="' . asset('storage/bukti_transfer/' . $transaksi->bayar->bukti_transfer) . '" width="50" alt="">
                            </a>
                        </div>
                    ';
                } else {
                    return '
                        <div class="d-flex justify-content-center">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#buktiTransferModal' . $transaksi->id . '" class="buktiTransfer">
                                <img src="' . asset('img/empty-bukti_transfer.jpg') . '" width="50" alt="">
                            </a>
                        </div>
                    ';
                }
            })
            ->editColumn('status', function ($transaksi) {
                return $transaksi->status == 0 ? '<div class="text-center"><p class="p-2 px-3 badge bg-secondary">Belum Bayar</p></div>'
                    : ($transaksi->status == 1 ? '<div class="text-center"><p class="p-2 px-3 badge bg-warning">Belum Disetujui</p></div>'
                        : ($transaksi->status == 2 ? '<div class="text-center"><p class="p-2 px-3 badge bg-success">Sedang Beroperasi</p></div>'
                            : ($transaksi->status == 3 ? '<div class="text-center"><p class="p-2 px-3 badge bg-primary">Selesai</p></div>'
                                : '<div class="text-center"><p class="p-2 px-3 badge bg-danger">Dibatalkan</p></div>')));
            })
            ->addIndexColumn()
            ->escapeColumns(['action'])
            ->toJson();
    }
}
