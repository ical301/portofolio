<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Absen Siswa per Kelas</title>
    <!-- ✅ Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4">Daftar Absen Siswa per Kelas</h2>

    @foreach ($kelasList as $kelas)
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <strong>Kelas: {{ $kelas->nama_kelas }}-{{ $kelas->jurusan }}</strong>
            </div>
            <div class="card-body">
                @php
                    $siswaAbsen = $siswaSudahAbsen->get($kelas->id);
                @endphp

                @if (!$siswaAbsen || $siswaAbsen->isEmpty())
                    <p class="text-muted">Belum ada siswa yang absen hari ini.</p>
                @else
                    <ul class="list-group">
                        @foreach ($siswaAbsen as $siswa)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $siswa->nama }}
                                <span class="badge bg-success">Sudah Absen</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    @endforeach

</div>

<!-- ✅ Bootstrap JS (opsional, hanya jika butuh interaktivitas) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
