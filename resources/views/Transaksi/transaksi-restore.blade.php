@extends('layouts.sidebar')

@section('title','Data Transaksi')

@section('content')
<h2>Restore Data Transaksi</h2>

<div class="container">
    <div class="my-3 d-flex justify-content-between align-items-center">
        <div class="col-12 col-sm-8 col-md-5">
            <form action="" method="get">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="keyword" placeholder="keyword">
                    <button class="input-group-text btn btn-primary bi bi-search"></button>
                </div>
            </form>
        </div>
    </div>
</div>


<table class="table m-2">
    <tr>
        <th>#</th>
        <th>Barang</th>
        <th>Kasir</th>
        <th>Tanggal</th>
        <th>Jumlah</th>
        <th>Total</th>
        <th>Action</th>

    </tr>
    @foreach($listDeleted as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->barang->name }}</td>
        <td>{{ $item->kasir->name }}</td>
        <td>{{ $item->created_at }}</td>
        <td>{{ $item->qty }}</td>
        <td>{{ $item->total }}</td>
        <td>
            <a href="edit-transaksi/{{ $item->id }}" class="btn btn-warning bi bi-cloud-arrow-up-fill"></a>
            {{-- <form class="d-inline" action="/transaksi/{{ $item->id }}" method="POST" onclick="return confirm('are you sure?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger bi bi-trash"></button>
            </form> --}}
        </td>
    </tr>
    @endforeach
</table>
{{-- <div class="my-5">
    {{ $listDeleted->links() }}
</div> --}}
@endsection