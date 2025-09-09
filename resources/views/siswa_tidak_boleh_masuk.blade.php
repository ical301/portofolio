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
  <!-- Bootstrap CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap JS Bundle CDN -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
  <!-- peringatan siswa masuk -->
  <div class="container mt-5">

    <!-- Peringatan responsif -->
    <div class="alert alert-warning alert-dismissible fade show shadow-sm" role="alert">
      <strong>Perhatian!</strong> Ini adalah RUANG GURU. Silakan  kembali.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

  </div>
  <!-- about section -->
  <section class="about_section layout_padding">
    <div class="container">
      <h2 class="main-heading ">
        About School
      </h2>
      <p class="text-center">
        There are many variations of passages of Lorem Ipsum available, but the majority hThere are many variations of
        passages of Lorem Ipsum available, but the majority h
      </p>
      <div class="about_img-box ">
        <img src="images/kids.jpg" alt="" class="img-fluid w-100">
      </div>
      <div class="d-flex justify-content-center mt-5">
        <a href="" class="call_to-btn  ">

          <span>
            Read More
          </span>
          <img src="images/right-arrow.png" alt="">
        </a>
      </div>
    </div>
  </section>
  <!-- about section -->
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
</body>

</html>