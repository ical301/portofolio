
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/css-circular-prog-bar.css') }}" />
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
  <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />
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

 @if(session('success'))
    <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
      {{ session('success') }}
    </div>
  @endif

  @if(session('error'))
    <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
      {{ session('error') }}
    </div>
  @endif
  @php use Illuminate\Support\Str; @endphp
  <h2>Jawaban Siswa di Kelas: {{ $kelas->nama }}</h2>
  <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
      <thead>
          <tr>
              <th>No</th>
              <th>Nama Siswa</th>
              <th>Jawaban</th>
              <th>Judul Tugas dari Guru</th>
          </tr>
      </thead>
      <tbody>
          @php 
              $no = 1; 
          @endphp

          {{-- ✅ Bagian 1: Siswa yang sudah jawab --}}
          @foreach($kelas->siswa as $siswa)
              @foreach($siswa->tugas_dari_siswa as $tugasSiswa)
                  @php
                      $jawaban = $tugasSiswa->file_url;
                      $ext = strtolower(pathinfo($jawaban, PATHINFO_EXTENSION));
                      $url = asset('jawaban_tugas/' . $jawaban);
                  @endphp
                  <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $siswa->nama }}</td>
                      <td>
                          @if(in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                              <a href="{{ $url }}" target="_blank">
                                  <img src="{{ $url }}" alt="Gambar Jawaban" style="max-height: 80px; max-width: 80px; object-fit: cover;">
                              </a>
                          @elseif(in_array($ext, ['mp4', 'webm', 'ogg']))
                              <video controls style="max-height: 100px; max-width: 150px;">
                                  <source src="{{ $url }}" type="video/{{ $ext }}">
                                  Browser tidak mendukung video.
                              </video>
                          @elseif($ext === 'pdf')
                              <a href="{{ $url }}" target="_blank">📄 Lihat PDF</a>
                          @else
                              {{ $jawaban }}
                          @endif
                      </td>
                      <td>{{ $tugasSiswa->tugas_dari_guru->title?? 'Tidak ditemukan' }}</td>
                  </tr>
              @endforeach
          @endforeach

          {{-- ❌ Bagian 2: Siswa yang belum jawab --}}
          @foreach($kelas->siswa as $siswa)
              @if($siswa->tugas_dari_siswa->isEmpty())
                  <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $siswa->nama }}</td>
                      <td colspan="2">Belum mengumpulkan tugas</td>
                  </tr>
              @endif
          @endforeach
      </tbody>
  </table>
  <!-- end data siswa perkelas -->

  <!-- about section -->
  @auth
    @if(auth()->user()->role === 'siswa')
      <section class="about_section layout_padding">
        <div class="container">
          <h2 class="main-heading ">
            Kerjakan Tugas Sekarang 
          </h2>
          <p class="text-center">
            There are many variations of passages of Lorem Ipsum available, but the majority hThere are many variations of
            passages of Lorem Ipsum available, but the majority h
          </p>
          <div class="about_img-box ">
            <img src="images/kids.jpg" alt="" class="img-fluid w-100">
          </div>
          <p class="text-center text-success fs-4">
            Klik disini!!!
          </p>
          <div class="d-flex justify-content-center mt-2">
            <a href="{{ route('kerjakantugas', $kelas->id) }}" class="call_to-btn">
              <span>
                Masuk ruangan dan kerjakan tugas
              </span>
              <img src="images/right-arrow.png" alt="">
            </a>
          </div>
        </div>
      </section>
    @endif
  @endauth

  <!-- footer section -->
  <section class="container-fluid footer_section">
    <p>
      Copyright &copy; 2019 All Rights Reserved By
      <a href="https://html.design/">Free Html Templates</a>
    </p>
  </section>
  <!-- footer section -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.js') }}"></script>


</body>

</html>
