<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengumuman Berhasil Dikirim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <!-- Alert Sukses -->
        <div class="alert alert-success shadow-sm" role="alert">
            <h4 class="alert-heading">🎉 Pengumuman Berhasil Dikirim!</h4>
            <p>Pengumuman berikut telah berhasil dibuat dan dikirim ke semua siswa:</p>
        </div>

        <!-- Kartu Detail Pengumuman -->
        <div class="card shadow-sm mt-4">
            <div class="card-header bg-primary text-white">
                <strong>{{ $pengumuman->subject }}</strong>
            </div>
            <div class="card-body">
                <p><strong>Guru Pengumuman:</strong> {{ $pengumuman->teacher_name }}</p>
                <p><strong>Isi Pengumuman:</strong></p>
                <div class="border p-3 bg-light rounded">
                    {{ $pengumuman->message }}
                </div>
                <p class="mt-3"><strong>Tanggal Pengumuman:</strong> 
                    {{ \Carbon\Carbon::parse($pengumuman->announce_date)->translatedFormat('l, d F Y - H:i') }}
                </p>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="mt-4">
            <a href="{{route('index')}}" class="btn btn-outline-primary">📋 Kembali ke Beranda</a>
            <a href="{{route('form_pengumuman')}}" class="btn btn-primary">➕ Buat Pengumuman Baru</a>
        </div>
    </div>

</body>
</html>
