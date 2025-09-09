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

        table {
        width: 100%;
        border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #333;
        }
        th, td {
            padding: 6px;
            font-size: 12px;
        }
        

    </style>
</head>
<body>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="container">
<form action="{{ route('export-pdf2') }}" method="GET" class="mx-5 my-5 btn-export-ignore">
    <input type="hidden" name="kelas_id" value="{{$kelasId}}">
    <input type="hidden" name="mataPelajaran" value="{{$mataPelajaran}}">
    <button type="submit" class="btn btn-danger">
        Export PDF
    </button>
</form>
    @if ($test->isNotEmpty())
    <h2 class="mb-4 text-center">Nilai Siswa {{ $test[0]->kelas->nama_kelas }} {{ $test[0]->kelas->jurusan }} </h2>
    @endif

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                @foreach ($test2 as $mapel)
                    <th>{{ ucwords($mapel) }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            
           @foreach ($test as $index => $s)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $s->nama }}</td>
                    @foreach ($test2 as $mapel)
                        @php
                            $jawabanMapel = $s->tugas_dari_siswa->filter(function ($j) use ($mapel, $s) {
                                // Ambil mata pelajaran dan kelas_id dari relasi tugas_dari_guru
                                $mp = optional($j->tugas_dari_guru)->title;
                                $kelasIdTugas = optional($j->tugas_dari_guru)->kelas_id;
                                
                                // Bandingkan case-insensitive untuk mata pelajaran dan kelas_id harus sama
                                return $mp && strcasecmp($mp, $mapel) === 0
                                    && $kelasIdTugas === $s->kelas_id;
                            });

                            $nilai = $jawabanMapel->pluck('nilai')->filter()->avg();
                            $firstJawaban = $jawabanMapel->first();
                        @endphp
                        <td>
                            {{ $nilai !== null ? round($nilai, 1) : '-' }}<br>
                            @if ($firstJawaban && $firstJawaban->file_url)
                                <a href="{{ asset('storage/' . $firstJawaban->file_url) }}" target="_blank">
                                </a>
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>








<!-- Bootstrap JS from CDN -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
