@extends('layouts.sidebar')

@section('title','Add-Barang')

@section('content')
<div class="m-5">
    <h3>Edit Barang</h3>
    <form action="/barang/{{ $data->id }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="name" class="form-control" id="name" name="name" placeholder="Enter name" value="{{ $data->name }}">
        </div>
        <div class="form-group">
            <label for="stok">Stok</label>
            <input type="number" class="form-control" id="stok" name="stok" placeholder="Enter stok" value="{{ $data->stok }}">
        </div>
        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="text" class="form-control" id="harga" name="harga" placeholder="Enter harga" value="{{ $data->harga }}">
        </div>
        <div class="form-group">
            <label for="harga">Pemasok</label>
            <select name="pemasok_id" id="pemasok_id" class="form-control">
                <option value="{{ $data->pemasok_id }}">
        {{ optional($data->pemasok)->name ?? 'Tidak ada pemasok' }}
    </option>
                @foreach($pemasok as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mt-3">
            <button type="submit" class="btn btn-success">Update</button>
        </div>
    </form>
</div>
@endsection