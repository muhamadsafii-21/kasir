<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Barang;
use App\Models\Pemasok;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
        {
            $data = Barang::with('pemasok')->get();
            $stok = Barang::sum('stok');
            // terjual
            $today = Carbon::today();
            $thisMonth = Carbon::now()->month;
            $hari = Transaksi::whereDate('created_at', $today)->sum('qty');
            $bulan = Transaksi::whereMonth('created_at', $thisMonth)->sum('qty');
            // 
            return view('barang.barang', ['data' => $data, 'stok' => $stok, 'hari' => $hari, 'bulan' => $bulan]);
        }
    public function show($id)
        {
            # code...
        }
    public function create()
        {
            $pemasok = Pemasok::select('id','name')->get();
            return view('barang.add-barang',['pemasok' => $pemasok]);
        }
    public function store(Request $request)
        {
            Barang::create($request->all());
            return redirect('/barang');
        }
    public function edit($id)
        {
            $data = Barang::with('pemasok')->findOrFail($id);
            $pemasok = Pemasok::select('id','name')->get();
            return view('barang.edit-barang',['data' => $data, 'pemasok' => $pemasok]);
        }
    public function update(Request $request, $id)
        {
            $data = Barang::with('pemasok')->findOrFail($id);
            $data->update($request->all());
            return redirect('/barang');
        }
    public function delete($id)
        {
    $barang = Barang::with('transaksis')->findOrFail($id);

    // Hapus semua transaksi terkait (soft delete)
    if ($barang->transaksis()->count() > 0) {
        $barang->transaksis()->delete();
    }

    // Hapus barang
    $barang->delete();

    return redirect('/barang')->with('success', 'Barang dan transaksi terkait berhasil dihapus.');
        }

}
