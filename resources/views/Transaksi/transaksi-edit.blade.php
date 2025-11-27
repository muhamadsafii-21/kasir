@extends('layouts.sidebar')

@section('title','Edit Data Transaksi')

@section('content')
<div class="m-5">
    <h3>Edit Transaksi</h3>
    <form action="/transaksi/{{ $data->id }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="x">Barang</label>
            <input type="text" class="form-control" id="x" readonly value="{{ $data->barang->name }}">
            <input type="hidden" name="barang_id" value="{{ $data->barang_id }}">
            <input type="hidden" name="kasir_id" value="{{ $data->kasir_id }}">
        </div>
        <div class="form-group">
            <label for="y">Kasir</label>
            <input type="text" class="form-control" id="y" readonly value="{{ $data->kasir->name }}">
        </div>
        <div class="form-group">
            <label for="z">tanggal</label>
            <input type="text" class="form-control" id="z" readonly value="{{ $data->created_at }}">
        </div>
        <div class="form-group">
            <label for="qty">Jumlah</label>
            <input type="text" class="form-control" id="qty" name="qty" value="{{ $data->qty }}">
        </div>
        <div class="form-group">
            <label for="total">Total</label>
            <input type="text" class="form-control" id="total" name="total" readonly value="{{ $data->total }}">
        </div>
        <div class="form-group mt-3">
            <button type="submit" class="btn btn-success">Update</button>
        </div>
    </form>
</div>
@endsection