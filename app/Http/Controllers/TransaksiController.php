<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kasir;
use App\Models\Retur;
use App\Models\TempPurchase;
use App\Models\Transaksi;
use App\Rules\StockSufficient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
   public function index(Request $request)
{
    $keyword = $request->keyword;

    $data = Transaksi::with('kasir','barang')
        ->when($keyword, function($query, $keyword){
            $query->whereDate('created_at', 'LIKE', '%'.$keyword.'%');
        })
        ->orderByDesc('id')
        ->paginate(10);

    // Rekapan Harian
    $rekapHarian = Transaksi::whereDate('created_at', today())
                    ->selectRaw('SUM(qty) as total_qty, SUM(total) as total_omzet')
                    ->first();

    // Rekapan Bulanan
    $rekapBulanan = Transaksi::whereMonth('created_at', now()->month)
                    ->selectRaw('SUM(qty) as total_qty, SUM(total) as total_omzet')
                    ->first();

    return view('transaksi.transaksi', [
        'data' => $data,
        'rekapHarian' => $rekapHarian,
        'rekapBulanan' => $rekapBulanan
    ]);
}

    public function show($id)
        {
            # code...
        }
    public function create()
        {
            $barang = Barang::select('id','name','harga')->get();
            $karyawan = Kasir::select('id','name')->get();
            $data = TempPurchase::with('kasir','barang')->get();
            return view('transaksi.transaksi-kasir', ['barang' => $barang, 'data' => $data, 'karyawan' => $karyawan]);
            
        }
    public function store(Request $request)
        {
            $id = $request['barang_id'];
            $barang = Barang::findOrFail($id);
            $harga = $barang['harga'];
            // 
            $request['total'] = $harga * $request['qty'];

            if($barang['stok'] < $request->qty){
                session()->flash('error', 'Tidak dapat melakukan insert ke tabel transaksi karena Stok tidak Mencukupi!');
                return redirect()->back();
            }

            TempPurchase::create($request->all());
            return redirect('/transaksi-kasir');
        }
        public function confirm(Request $request)
        {
            $temp = TempPurchase::all();

            if(count($temp) == 0) {
                // Simpan pesan error dalam session flash data
                session()->flash('error', 'Tidak dapat melakukan insert ke tabel transaksi karena keranjang kosong!');
                // Redirect kembali ke halaman sebelumnya
                return redirect()->back();
            }
            // validasi di tabel temporary
            $totalStok = 0;
            foreach($temp as $purchase){
                $barang = Barang::find($purchase->barang_id);
                $totalStok += $barang->stok;
                $totalStok -= $purchase->qty;
            }
            if($totalStok < 0){
                // Simpan pesan error dalam session flash data
                session()->flash('error', 'Total stok barang tidak mencukupi untuk melakukan transaksi!');
                        
                // Redirect kembali ke halaman sebelumnya
                return redirect()->back();
            }
            //
            foreach($temp as $purchase){
                $transaksi = new Transaksi();
                $transaksi->barang_id = $purchase->barang_id;
                $transaksi->kasir_id = $purchase->kasir_id;
                $transaksi->qty = $purchase->qty;
                $transaksi->total = $purchase->total;
                $transaksi->save();
            }
            TempPurchase::truncate();
            // Simpan pesan sukses dalam session flash data
            session()->flash('success', 'Data transaksi berhasil disimpan!');
            return redirect('/transaksi-kasir');
        }

    public function edit($id)
        {
            $data = Transaksi::with('barang','kasir')->findOrFail($id);
            Return view("Transaksi.transaksi-edit", ['data' => $data]);
        }
    public function update(Request $request, $id)
        {
            $data = Transaksi::findOrFail($id);

            $idb = $request['barang_id'];
            $barang = Barang::findOrFail($idb);
            $harga = $barang['harga'];

            $request['total'] = $harga * $request['qty'];
            $data->update($request->all());
        }
    public function delete($id)
        {
            $data = TempPurchase::findOrFail($id);
            $data->delete();
            return redirect('/transaksi-kasir');
        }
    public function drop($id)
        {
            $data = Transaksi::findOrFail($id);
            $data->delete();
            return redirect('/transaksi');
        }
    public function view_restore()
    {
        $deleted = Transaksi::onlyTrashed()->get();
        return view('Transaksi.transaksi-restore', ['listDeleted' => $deleted]);
    }

}
