<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tugas & Jawaban</title>

    <!-- ✅ Bootstrap 5 CDN CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-XwEi0uEiYbYQdBGQvd5b7T/FJNPn2SpqxKn4X9rZPRsHdJfRMpknIkdHU8t2Pmfa" crossorigin="anonymous">
</head>
<body>
    <h3>Input Nilai Tugas: {{ $tugas->title }}</h3>

    <form action="{{ route('input.nilai.simpan') }}" method="POST">
        @csrf
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Siswa</th>
                    <th>Jawaban</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tugas->tugas_dari_siswa as $jawaban)
                    <tr>
                        <td>{{ $jawaban->siswa->nama }}</td>
                        <td>
                            <a href="{{ asset($jawaban->file_jawaban) }}" target="_blank">Lihat Jawaban</a>
                        </td>
                        <td>
                            <input type="number" name="nilai[{{ $jawaban->id }}]" value="{{ $jawaban->nilai ?? '' }}" min="0" max="100" class="form-control" required>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-success">Simpan Nilai</button>
    </form>


    <!-- ✅ Bootstrap 5 CDN JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Qrj7CQOqAqYHTA8M41YF5NoN0V+a2PvD51Kh+nToR5KtnR9iHGP59VvM8XycH4FZ" crossorigin="anonymous"></script>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Test Bootstrap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-success text-center">
            ✅  Anda berhasil mengumpulkan tugas!
        </div>
    </div>
</body>
</html>

