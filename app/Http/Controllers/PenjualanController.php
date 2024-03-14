<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index(Penjualan $penjualan, Produk $produk, Pelanggan $pelanggan)
    {
        $data_produk = $produk->readData();
        $data_pelanggan = $pelanggan->readData();
        $data_penjualan = $penjualan->readData();
        $nota = $penjualan->readNota();

        return view('penjualan.index', compact('data_produk', 'data_pelanggan', 'data_penjualan', 'nota'));
    }

    public function new($nota, Penjualan $penjualan)
    {
        session(['isNew' => true]);
        $nota = urldecode($nota);
        $penjualan->updateTotalPenjualan($nota);
        return redirect()->route('penjualan.index');
    }

    public function store(Request $request, Penjualan $penjualan)
    {
        $store = $penjualan->storeDataPenjualan($request);
        session()->forget('isNew');

        if ($store == false) {
            session()->flash('error', 'stok tidak cukup');
            return redirect()
                ->route('penjualan.index');
        } else {
            return redirect()
                ->route('penjualan.index');
        }

    }
}
