@extends('layouts.sidebar')

@section('title','Barang')

@section('content')
<div class="row mt-4 mb-3">    
    {{-- 2 --}}
    <div class="col-6 col-md-3">
        <div class="card" style="width: 260px; height: 100px; background-color: rgba(41, 104, 240, 0.733); color: aliceblue;">
            <div class="card-body text-center">
                <h4 class="card-title">Stok Keseluruhan</h4>
                <h5 class="card-title">{{ $stok }}</h5>
            </div>
        </div>
    </div>
    {{-- 3 --}}
    <div class="col-6 col-md-3">
        <div class="card" style="width: 260px; height: 100px; background-color: rgba(34, 197, 61, 0.959); color: aliceblue;">
            <div class="card-body text-center">
                <h4 class="card-title">Terjual (hari ini)</h4>
                <h5 class="card-title">{{ $hari }}</h5>
            </div>
        </div>
    </div>
    {{-- 4 --}}
    <div class="col-6 col-md-3">
        <div class="card" style="width: 260px; height: 100px; background-color: rgba(211, 120, 15, 0.959); color: aliceblue;">
            <div class="card-body text-center">
                <h4 class="card-title">Terjual (bulan ini)</h4>
                <h5 class="card-title">{{ $bulan }}</h5>
            </div>
        </div>
    </div>
</div>
<a class="btn btn-primary bi bi-plus-circle" href="barang-create"> New</a>  

<table class="table m-2">
    <tr>
        <th>#</th>
        <th>Nama</th>
        <th>Stok</th>
        <th>Harga</th>
        <th>Suplier</th>
        <th>Action</th>

    </tr>
    @foreach ($data as $item)        
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->name }}</td>
        <td>{{ $item->stok }}</td>
        <td>{{ $item->harga }}</td>
        <td>{{ $item->pemasok->name ?? 'Tidak ada pemasok' }}</td>
        <td>
            <a href="barang-edit/{{ $item->id }}" class="btn btn-success bi bi-pencil-fill"></a>
            <form action="barang/{{ $item->id }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger bi bi-trash" onclick="return confirm('are you sure?');"></button>
            </form>
            <a href="" ></a>
        </td>
    </tr>
    @endforeach
</table>
@endsection