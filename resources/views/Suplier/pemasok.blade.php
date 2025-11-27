@extends('layouts.sidebar')

@section('title','Suplier')

@section('content')
<div class="row mt-4 mb-3">    
    {{-- 3 --}}
    <div class="col-6 col-md-3">
        <div class="card" style="width: 260px; height: 100px; background-color: rgba(34, 197, 61, 0.959); color: aliceblue;">
            <div class="card-body text-center">
                <h4 class="card-title">Total Suplier</h4>
                <h5 class="card-title">{{ $jumlah }}</h5>
            </div>
        </div>
    </div>
</div>
<a class="btn btn-primary bi bi-plus-circle" href="/pemasok-create"> New</a>     
<table class="table m-2">
    <tr>
        <th>#</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>No HP</th>
        <th>Action</th>

    </tr>
    @foreach ($data as $item)        
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->name }}</td>
        <td>{{ $item->alamat }}</td>
        <td>{{ $item->nohp }}</td>
        <td>
            <a href="pemasok-edit/{{ $item->id }}" class="btn btn-success bi bi-pencil-fill"></a>
            <form action="pemasok/{{ $item->id }}" method="post" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger bi bi-trash" onclick="return confirm('are you sure?');"></button>
            </form>
        </td>
    </tr>
    @endforeach

</table>
@endsection