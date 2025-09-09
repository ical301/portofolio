<!DOCTYPE html>
<html lang="id">

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
  
  <!-- Bootstrap Core CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
  
  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

  <!-- Custom Styles -->
  <link href="css/style.css" rel="stylesheet" />
  <link href="css/responsive.css" rel="stylesheet" />
  
  <!-- Optional Styles for Circular Progress Bar -->
  <link rel="stylesheet" href="css/css-circular-prog-bar.css">

  <!-- Bootstrap JS Bundle CDN -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
  <!-- Top Container -->
  <div class="top_container sub_pages">
    <!-- Header Section -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand" href="index.html">
            <img src="images/logo.png" alt="">
            <span>Adward</span>
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
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
          </div>
        </nav>
      </div>
    </header>
  </div>

  <!-- Session Messages -->
  @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif
  @if(session('error'))
    <div class="alert alert-danger">
      {{ session('error') }}
    </div>
  @endif

  <!-- Filter Form -->
  <section class="filter-section w-50 mx-auto mt-5 ">
    <div class="container ">
      <form action="{{ route('filterTugas') }}" method="GET" class="row g-2">
        <div class="col-md-5">
          <label for="kelas" class="form-label">Pilih Kelas</label>
          <select name="kelas" id="kelas" class="form-select form-select-sm">
            <option value="">-- Pilih Kelas --</option>
            @foreach($kelas as $kelasItem)
              <option value="{{ $kelasItem->id }}" {{ request('kelas') == $kelasItem->id ? 'selected' : '' }}>
                {{ $kelasItem->nama_kelas }} {{ $kelasItem->jurusan }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="col-md-5">
          <label for="mata_pelajaran" class="form-label">Pilih Mata Pelajaran</label>
          <select name="mata_pelajaran" id="mata_pelajaran" class="form-select form-select-sm " r required>
            <option value="">-- Pilih Mata Pelajaran --</option>
            <option value="bahasa indonesia" {{ request('mata_pelajaran') == 'bahasa indonesia' ? 'selected' : '' }}>Bahasa Indonesia</option>
            <option value="bahasa inggris" {{ request('mata_pelajaran') == 'bahasa inggris' ? 'selected' : '' }}>Bahasa Inggris</option>
            <option value="matematika" {{ request('mata_pelajaran') == 'matematika' ? 'selected' : '' }}>Matematika</option>
            <option value="IPA" {{ request('mata_pelajaran') == 'ipa' ? 'selected' : '' }}>IPA</option>
          </select>
        </div>

        <div class="col-12 mt-2">
          <button type="submit" class="btn btn-primary w-100 w-sm-auto">Filter</button>
        </div>
      </form>
    </div>
  </section>

  <!-- About Section -->
  <section class="about_section layout_padding">
    <div class="container">
      <h2 class="main-heading text-center">About School</h2>
      <p class="text-center">
        There are many variations of passages of Lorem Ipsum available, but the majority h...
      </p>
      <div class="about_img-box">
        <img src="images/kids.jpg" alt="" class="img-fluid w-100">
      </div>
      <div class="d-flex justify-content-center mt-5">
        <a href="#" class="call_to-btn">
          <span>Read More</span>
          <img src="images/right-arrow.png" alt="">
        </a>
      </div>
    </div>
  </section>

  <!-- Footer Section -->
  <footer class="footer_section">
    <div class="container-fluid text-center py-3">
      <p>&copy; 2019 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a></p>
    </div>
  </footer>

  <!-- jQuery & Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>
