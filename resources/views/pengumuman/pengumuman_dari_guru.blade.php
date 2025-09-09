<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengumuman</title>
    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Buat Pengumuman Baru</h2>

        <form action="{{route('kirim_pengumuman')}}" method="POST">
            @csrf

            <!-- Subject -->
            <div class="mb-3">
                <label for="subject" class="form-label">Judul Pengumuman</label>
                <input type="text" class="form-control" id="subject" name="subject" required>
            </div>

            <!-- Message -->
            <div class="mb-3">
                <label for="message" class="form-label">Isi Pengumuman</label>
                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
            </div>

            <!-- Kelas -->
            <div class="mb-3">
                <label for="kelas_id" class="form-label">Pilih Kelas</label>
                <select class="form-select" id="kelas_id" name="kelas_id" required>
                    <option value="" disabled selected>-- Pilih Kelas --</option>
                    @foreach($kelas as $kls)
                        <option value="{{ $kls->id }}">{{ $kls->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Tombol Submit -->
            <button type="submit" class="btn btn-primary">Kirim Pengumuman</button>
        </form>
    </div>

    <!-- Bootstrap JS (Opsional, untuk komponen interaktif) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
