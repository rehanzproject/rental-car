<?php

namespace App\Http\Controllers;

use App\Models\Bayar;
use App\Models\Armada;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class BayarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $transaksiId)
    {
        $transaksi = Transaksi::findOrFail($transaksiId);

        // Validate Request //
        $data = $request->validate([
            'bukti_transfer' => 'required|image|file|max:2048'
        ]);

        // Request bukti_transfer //
        if ($request->hasFile('bukti_transfer')) {
            $imageName = $request->bukti_transfer->getClientOriginalName();

            $timestamp = now()->timestamp;
            $newImageName = $timestamp . '_' . $imageName;

            $request->bukti_transfer->storeAs('public/bukti_transfer', $newImageName);
            $data['bukti_transfer'] = $newImageName;
        }

        $bayar = Bayar::create($data);

        $findTransaksi = Transaksi::find($transaksi->id);
        $findTransaksi->update([
            'bayar_id' => $bayar->id,
            'status' => 1
        ]);

        return redirect('/transaksi')->with('success', 'Sukses Membayar Mobil');
    }

    public function setuju(Transaksi $transaksi)
    {
        $data['status'] = 2;

        $findTransaksi = Transaksi::find($transaksi->id);
        $findTransaksi->update($data);

        return redirect()->back()->with('success', 'Berhasil Menyetujui Pesanan');
    }

    public function selesai(Transaksi $transaksi)
    {
        $data['status'] = 3;

        $findTransaksi = Transaksi::find($transaksi->id);
        $findTransaksi->update($data);

        $findArmada = Armada::find($transaksi->armada_id);
        $findArmada->update([
            'status' => 0
        ]);

        return redirect()->back()->with('success', 'Berhasil Menyelesaikan Pesanan');
    }

    public function cancel(Transaksi $transaksi)
    {
        $data['status'] = 4;

        $findTransaksi = Transaksi::find($transaksi->id);
        $findTransaksi->update($data);

        $findArmada = Armada::find($transaksi->armada_id);
        $findArmada->update([
            'status' => 0
        ]);

        return redirect()->back()->with('success', 'Berhasil Membatalkan Pesanan');
    }
}
