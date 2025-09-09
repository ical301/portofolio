
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


  <!-- Bootstrap CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap JS Bundle CDN -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>



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

                <li class="nav-item ">
                  <a class="nav-link" href="{{route('materi.dan.tugas')}}"> Materi & tugas</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="{{route('absensisiswa')}}"> Absensi Siswa</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ Auth::user()->role === 'guru' ? route('lihat_jawaban_siswa') : route('lihat_jawaban_anda') }}">
                    {{ Auth::user()->role === 'guru' ? 'Lihat jawaban siswa' : 'Lihat jawaban anda' }}
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





  @foreach($kelas->siswa as $siswa)
  <div>{{$siswa->nama}}</div>
  @endforeach

 



  <h2>Daftar Siswa di Kelas: {{ $kelas->nama }}</h2>

<h2>Daftar Siswa di Kelas: {{ $kelas->nama }}</h2>

<table class="table table-bordered mt-4">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Jawaban Siswa</th>
            <th>Nilai</th>
            <th>Tugas Dari Guru</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kelas->siswa as $index => $siswa)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $siswa->nama }}</td>
                
                <!-- Tugas Dari Siswa -->
                <td>
                    @foreach ($siswa->tugas_dari_siswa as $tugasSiswa)
                        @if($tugasSiswa->file_url)
                            <!-- Menampilkan gambar jika file adalah gambar -->
                            @php
                                $ext = pathinfo($tugasSiswa->file_url, PATHINFO_EXTENSION);
                            @endphp
                            @if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif']))
                                <img src="{{ asset($tugasSiswa->file_url) }}" alt="Tugas Gambar" class="img-thumbnail" style="max-width: 200px;">
                            @elseif (strtolower($ext) == 'pdf')
                                <!-- Menampilkan PDF jika file berupa PDF -->
                                <a href="{{ asset($tugasSiswa->file_url) }}" target="_blank">Lihat Tugas PDF</a>
                            @else
                                <!-- Untuk tipe file lain, tampilkan link download -->
                                <a href="{{ asset($tugasSiswa->file_url) }}" target="_blank" class="btn btn-sm btn-link p-0">
                                    Lihat Tugas
                                </a>
                            @endif
                        @else
                            Tidak ada tugas yang dikumpulkan
                        @endif
                    @endforeach
                </td>
                
                <!-- Nilai -->
                <td>
                    @foreach ($siswa->tugas_dari_siswa as $tugasSiswa)
                        <p>{{ $tugasSiswa->nilai ?? 'Belum dinilai' }}</p>
                    @endforeach
                </td>
                
                <!-- Tugas Dari Guru -->
                <td>
                    @foreach ($siswa->tugas_dari_siswa as $tugasSiswa)
                        @if ($tugasSiswa->tugas_dari_guru)
                            <p>{{ $tugasSiswa->tugas_dari_guru->title ?? 'Tidak ada tugas dari guru' }}</p>
                        @endif
                    @endforeach
                </td>
            </tr>
        @endforeach
    </tbody>
</table>









<h3>Pilih Mata Pelajaran</h3>
<ul>
  @foreach($tugas_dari_guru as $mapel)
        <li>
            <a href="{{route('input.nilai.form',$mapel->id)}}">{{ $mapel->title }}</a>
        </li>
  @endforeach
</ul>
<h2>aso</h2>

  <!-- about section -->

  <!-- footer section -->
  <section class="container-fluid footer_section">
    <p>
      Copyright &copy; 2019 All Rights Reserved By
      <a href="https://html.design/">Free Html Templates</a>
    </p>
  </section>
  <!-- footer section -->

  <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.js') }}"></script>


</body>

</html>
