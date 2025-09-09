<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Tugas</title>

    <!-- Bootstrap CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optional: Additional stylesheets -->
    <style>
        table {
            width: 100%;
            margin-top: 20px;
        }
        table th, table td {
            text-align: center;
            vertical-align: middle;
        }
        .container {
            margin-top: 50px;
        }
        .btn-xs {
            padding: 0.25rem 0.4rem;
            font-size: 0.75rem;
            line-height: 1.2;
            border-radius: 0.2rem;
        }

    </style>
</head>
<body>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('export-pdf') }}" method="GET" class="mx-5 my-5 btn-export-ignore">
        <input type="hidden" name="kelas_id" value="{{$kelasId}}">
        <input type="hidden" name="mataPelajaran" value="{{$mataPelajaran}}">
        <button type="submit" class="btn btn-danger">
           Laporan nilai persiswa 
        </button>
    </form>

    <div class="container">
        <h2 class="mb-4 text-center">Materi {{ $tugas->first()->title ?? 'Pilih Filter Tugas' }}</h2>
        <!-- Responsive Table -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>jawaban Dari Siswa</th>
                        <th>Nilai</th>
                        <th>Tugas Dari Guru</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach($tugas as $tugas)
                        @foreach($tugas->tugas_dari_siswa as $jawaban)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $jawaban->siswa->nama }}</td>
                                <td>
                                    @if($jawaban->file_url)
                                        <a href="{{ asset('storage/' . $jawaban->file_url) }}" target="_blank">Lihat Tugas PDF</a>
                                    @else
                                        Belum mengumpulkan
                                    @endif
                                </td>
                                <td class="btn-export-ignore">
                                    @if ($jawaban->nilai !== null)
                                        {{-- Nilai sudah diberikan, tampilkan nilainya --}}
                                        <span>{{ $jawaban->nilai }}</span>
                                    @else
                                        {{-- Form untuk Input Nilai --}}
                                        <form action="{{ route('berikan.nilai', $jawaban->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="siswa_id" value="{{ $jawaban->siswa->id }}">
                                            <input type="number" name="nilai" class="form-control" value="{{ old('nilai') }}" min="0" max="100" step="1" required>
                                            <button type="submit" class="btn btn-sm btn-success mt-2 btn-xs">Simpan Nilai</button>
                                        </form>
                                    @endif
                                </td>

                                <td>{{ $tugas->title }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
