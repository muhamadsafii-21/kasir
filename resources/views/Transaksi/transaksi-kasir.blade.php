@extends('layouts.sidebar')

@section('title','Kasir')
@section('content')

<div class="container">
  {{--  --}}
  <br>
  @if (session('error'))
  <div class="alert alert-danger">
      {{ session('error') }}
  </div>
  @endif

  @if (session('success'))
  <div class="alert alert-success">
      {{ session('success') }}
  </div>
  @endif
  {{--  --}}
    <h1>Kasir</h1>
    <div class="row">
      <div class="col-md-6">
        <form action="/transaksi" method="POST">
            @csrf
            <div class="form-group">
              <label for="name">Kasir:</label>
              <select id="js-example-basic-single1" name="kasir_id" class="form-control">
                  @foreach ($karyawan as $item)
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
                  @endforeach
              </select>
            </div>
          <div class="form-group">
            <label for="name">Barang:</label>
            <select id="js-example-basic-single2" name="barang_id" class="form-control">
                @foreach ($barang as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="qty">Qty:</label>
            <input type="number" class="form-control" id="qty" name="qty" required oninput="validity.valid||(value='');" min="1">
          </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="total">Total:</label>
          <input type="text" class="form-control" id="total-keseluruhan" readonly name="total-keseluruhan">
        </div>
        <div class="btn-group mt-3">
          <form action="/transaksi" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary me-3" style="width: 50%">Tambahkan</button>
          </form>
          <form action="/transaksi-confirm" method="POST">
            @csrf
            <button type="submit" class="btn btn-success me-5 ms-5" style="width: 50%">Konfirmasi</button>
          </form>
        </div>
      </div>
      
    </form>

    </div>
    {{--  --}}<br>
    <h2>Keranjang</h2>
    <table class="table" id="table-data">
      <tr>
          <th>No</th>
          <th>Nama Barang</th>
          <th>Harga</th>
          <th>Jumlah</th>
          <th>Total</th>
          <th>Action</th>
      </tr>
      @foreach($data as $item)
      <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $item->barang->name }}</td>
          <td>{{ $item->barang->harga }}</td>
          <td>{{ $item->qty }}</td>
          <td>{{ $item->total }}</td>
          <td>
              <form action="/delete-transaksi/{{ $item->id }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-warning">cancel</button>
              </form>
          </td>
      </tr>
      @endforeach
  </table>
  
</div>
  
<!-- Inisialisasi Select2 pada combo box -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
{{-- Combobox --}}
<script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
    $('#js-example-basic-single1').select2({

    });
    $('#js-example-basic-single2').select2({

  });
});
</script>
{{-- Total-keseluruhan --}}
<script>
  var table = document.getElementById('table-data');
  var rows = table.getElementsByTagName('tr');
  var total = 0;

  for (var i = 1; i < rows.length; i++) {
      var subtotal = parseInt(rows[i].getElementsByTagName('td')[4].textContent);
      total += subtotal;
  }

  document.getElementById('total-keseluruhan').value = total.toLocaleString('id-ID', {style: 'currency', currency: 'IDR'});
</script>

@endsection