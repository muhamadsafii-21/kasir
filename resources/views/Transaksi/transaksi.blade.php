@extends('layouts.sidebar')

@section('title','Data Transaksi')

@section('content')
<h2 class="mb-4">Data Transaksi</h2>

<div class="container mb-4">
    <div class="row align-items-center mb-3">
        <div class="col-md-6 col-lg-5">
            <form action="" method="get" class="d-flex">
                <input type="text" class="form-control me-2" name="keyword" placeholder="Cari berdasarkan tanggal atau barang">
                <button class="btn btn-primary bi bi-search"> Cari</button>
            </form>
        </div>
        <div class="col-md-auto ms-auto">
            <a href="/transaksi-restore" class="btn btn-warning bi bi-cloud-arrow-down-fill"> Restore</a>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    Rekapan Hari Ini ({{ \Carbon\Carbon::today()->format('d M Y') }})
                </div>
                <div class="card-body">
                    <p class="mb-1"><strong>Qty Terjual:</strong> {{ $rekapHarian->total_qty ?? 0 }}</p>
                    <p class="mb-0"><strong>Total Omzet:</strong> Rp {{ number_format($rekapHarian->total_omzet ?? 0,0,',','.') }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    Rekapan Bulan Ini ({{ \Carbon\Carbon::now()->format('F Y') }})
                </div>
                <div class="card-body">
                    <p class="mb-1"><strong>Qty Terjual:</strong> {{ $rekapBulanan->total_qty ?? 0 }}</p>
                    <p class="mb-0"><strong>Total Omzet:</strong> Rp {{ number_format($rekapBulanan->total_omzet ?? 0,0,',','.') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Transaksi -->
<div class="table-responsive-sm" style="max-width: 95%;">
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th style="width: 3%;">#</th>
                <th style="width: 25%;">Barang</th>
                <th style="width: 20%;">Kasir</th>
                <th style="width: 15%;">Tanggal</th>
                <th style="width: 10%;">Jumlah</th>
                <th style="width: 15%;">Total</th>
                <th style="width: 12%;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td class="text-truncate" style="max-width: 150px;">{{ $item->barang->name }}</td>
                <td class="text-truncate" style="max-width: 120px;">{{ $item->kasir->name }}</td>
                <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                <td>{{ $item->qty }}</td>
                <td>Rp {{ number_format($item->total,0,',','.') }}</td>
                <td>
                    <form class="d-inline" action="/transaksi/{{ $item->id }}" method="POST" onclick="return confirm('Apakah yakin ingin menghapus?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm bi bi-trash"></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="my-4">
    {{ $data->links() }}
</div>
@endsection
