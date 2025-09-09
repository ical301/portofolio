<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Adward</title>
  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <!-- progress barstle -->
  <link rel="stylesheet" href="css/css-circular-prog-bar.css">
  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
  <!-- font wesome stylesheet -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/css-circular-prog-bar.css">
</head>
<body>
  <div class="top_container sub_pages">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="index.html">
            <img src="images/logo.png" alt="">
            <span>
              Adward
            </span>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
              <ul class="navbar-nav  ">
                <li class="nav-item active">
                  <a class="nav-link" href="{{route('index')}}"> Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ Auth::user()->role === 'guru' ? route('masuk.kelas.2') : route('pendaftaran_siswa') }}">
                    {{ Auth::user()->role === 'guru' ? 'Masuk Kelas -' : 'Masuk Kelas' }}
                  </a>
                </li>
                 <li class="nav-item">
                  <a class="nav-link" href="{{ Auth::user()->role === 'guru' ? route('materi.dan.tugas') : route('index') }}">
                    {{ Auth::user()->role === 'guru' ? ' Materi & tugas' : 'Ruang guru' }}
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ Auth::user()->role === 'guru' ? route('absensisiswa') : route('index') }}">
                    {{ Auth::user()->role === 'guru' ? 'Absensi Siswa' : 'Absensi Siswa' }}
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ Auth::user()->role === 'guru' ? route('lihat_jawaban_siswa') : route('lihat_jawaban_anda') }}">
                    {{ Auth::user()->role === 'guru' ? 'Lihat jawaban siswa' : 'Lihat jawaban anda' }}
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ Auth::user()->role === 'guru' ? route('masuk_nilai_berdasarkan_kelas') : route('index') }}">
                    {{ Auth::user()->role === 'guru' ? 'Penilaian siswa' : '' }}
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ Auth::user()->role === 'guru' ? route('laporan.dan.statistik') : route('index') }}">
                    {{ Auth::user()->role === 'guru' ? 'Laporan & statistik' : 'Laporan & statistik' }}
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ Auth::user()->role === 'guru' ? route('form_pengumuman') : route('index') }}">
                    {{ Auth::user()->role === 'guru' ? 'Pengumuman & siaran' : 'Pengumuman & siaran' }}
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link"  href="{{ route('logout') }}"
                     onclick="event.preventDefault(); 
                              if (confirm('Apakah Anda yakin ingin keluar?')) {
                                  document.getElementById('logout-form').submit();
                              }">
                      Logout
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                </li>

              </ul>
              <form class="form-inline my-2 my-lg-0 ml-0 ml-lg-4 mb-3 mb-lg-0">
                <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit"></button>
              </form>
            </div>
        </nav>
      </div>
    </header>
  </div>
  <!-- end header section -->
  <!-- teacher section -->
  <section class="teacher_section layout_padding-bottom">
    <div class="container">
      <h2 class="main-heading ">
        List Kelas
      </h2>
      <p class="text-center">
        Silahkan edit atau hapus kelas!!!!
      </p>

      <!-- tabel list kelas -->
      <div class="container">
        {{-- Alert Sukses --}}
        @if(session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kelas</th>
                    <th>Jurusan</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kelas as $index => $kelas)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $kelas->nama_kelas }}</td>
                        <td>{{ $kelas->jurusan }}</td>
                        <td>{{ $kelas->description }}</td>
                        <td>
                            <a href="{{ route('formEditkelas', $kelas->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            
                            <form action="{{ route('hapuskelas', $kelas->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin mau hapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data kelas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
      </div>
      <!-- end list tabel kelas -->
      <div class="teacher_container layout_padding2">
        <div class="card-deck">
          <div class="card">
            <img class="card-img-top" src="images/teacher-1.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Den Mark</h5>
            </div>
          </div>
          <div class="card">
            <img class="card-img-top" src="images/teacher-2.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Leena jorj</h5>
            </div>

          </div>
          <div class="card">
            <img class="card-img-top" src="images/teacher-3.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Magi Den</h5>

            </div>

          </div>

          <div class="card">
            <img class="card-img-top" src="images/teacher-4.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">jonson mark</h5>
            </div>
          </div>
        </div>
      </div>
      <div class="d-flex justify-content-center mt-3">
        <a href="" class="call_to-btn  ">

          <span>
            See More
          </span>
          <img src="images/right-arrow.png" alt="">
        </a>
      </div>
    </div>
  </section>
  <!-- footer section -->
  <section class="container-fluid footer_section">
    <p>
      Copyright &copy; 2019 All Rights Reserved By
      <a href="https://html.design/">Free Html Templates</a>
    </p>
  </section>
  <!-- footer section -->

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <!-- progreesbar script -->

  </script>
  <script>
    function initMap() {
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 11,
        center: {
          lat: 40.645037,
          lng: -73.880224
        },
      });

      var image = 'images/maps-and-flags.png';
      var beachMarker = new google.maps.Marker({
        position: {
          lat: 40.645037,
          lng: -73.880224
        },
        map: map,
        icon: image
      });
    }
  </script>
  <!-- google map js -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8eaHt9Dh5H57Zh0xVTqxVdBFCvFMqFjQ&callback=initMap">
  </script>
  <!-- end google map js -->
</body>

</html>