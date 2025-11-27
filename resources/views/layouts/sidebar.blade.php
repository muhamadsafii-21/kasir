<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | Page</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

   
<style>
#sidebar {
    background-color: #5a6d8c;
    width: 400px;
    min-height: 100vh;
    padding: 30px 25px;
    color: #fff;
}

#sidebar h2 {
    font-size: 2rem;
    margin-bottom: 30px;
    color: #e0e0e0;
}

#sidebar ul {
    list-style: none;
    padding-left: 0;
}

#sidebar li {
    margin-bottom: 18px;
}

#sidebar li a {
    font-size: 1.3rem;
    font-weight: 600;
    padding: 12px 20px;
    border-radius: 6px;
    display: flex;           /* supaya icon & teks sejajar */
    align-items: center;     /* vertical center */
    color: white;
    text-decoration: none;
    transition: background-color 0.3s, transform 0.2s;
}

#sidebar li a i {
    margin-right: 15px; /* jarak icon ke teks */
    font-size: 1.5rem;
}

#sidebar li a:hover {
    background-color: rgba(255, 255, 255, 0.2);
    transform: scale(1.02);
}

@media (max-width: 992px) {
    #sidebar {
        width: 250px;
        padding: 20px;
    }
    #sidebar li a {
        font-size: 1.1rem;
    }
}
</style>


</head>
<body class="wrapper">
    <div class="container-fluid">
        <div class="row">
          <!-- Sidebar -->
          <div class="col-md-3" id="sidebar">
            <!-- isi sidebar -->
            <h2>Menu</h2>
            <br />
            <ul class="list-group">
              <li type="none" class="mb-2 bi "><a href="/">Dashboard</a></li>
              <li type="none" class="mb-2 bi "><a href="/transaksi-kasir">Kasir</a></li>
              <li type="none" class="mb-2 bi "><a href="/barang">Barang</a></li>
              <li type="none" class="mb-2 bi "><a href="/karyawan">Karyawan</a></li>
              <li type="none" class="mb-2 bi "><a href="/pemasok">Suplier</a></li>
              <li type="none" class="mb-2 bi "><a href="/transaksi">Data Jual</a></li>
              <li type="none" class="mb-2 bi "><a href="#">Logout</a></li>

            </ul>
          </div>
  
          <!-- Content -->
          <div class="col-md-9" id="content">
          @yield('content')

            <!-- Footer -->
            {{-- <div class="row mt-3" id="footer">
              <div class="col-md-12 text-center">&copy; 2023 - SamHD</div>
            </div> --}}
          </div>
        </div>
      </div>
      <!-- Load Bootstrap JS -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>

