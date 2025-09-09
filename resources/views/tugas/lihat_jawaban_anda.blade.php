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

    <div class="container mt-4">
        <h4 class="mb-4 text-center">Daftar Tugas & Jawaban - {{ $user->name }}</h4>

        @forelse ($user->tugas_dari_siswa as $jawaban)
            <div class="border rounded p-3 mb-3 bg-light shadow-sm">
                <h5 class="text-primary">{{ $jawaban->tugas_dari_guru->title ?? 'Judul tidak tersedia' }}</h5>
                
                <p class="mb-1"><strong>Deskripsi:</strong></p>
                <p class="text-muted mb-2">
                    {{ $jawaban->tugas_dari_guru->description ?? 'Tidak ada deskripsi.' }}
                </p>

                <p class="mb-1"><strong>Jawaban Anda:</strong></p>
                @if ($jawaban->file_url)
                    <a href="{{ asset('storage/' . $jawaban->file_url) }}" class="btn btn-sm btn-success" target="_blank">
                        📄 Lihat Jawaban
                    </a>
                @else
                    <span class="text-danger">Anda belum mengumpulkan jawaban.</span>
                @endif

                {{-- Tambahan info jika ada --}}
                @if ($jawaban->grade || $jawaban->feedback)
                    <div class="mt-3">
                        @if ($jawaban->grade)
                            <p><strong>Nilai:</strong> {{ $jawaban->grade }}</p>
                        @endif
                        @if ($jawaban->feedback)
                            <p><strong>Feedback Guru:</strong> {{ $jawaban->feedback }}</p>
                        @endif
                    </div>
                @endif
            </div>
        @empty
            <div class="alert alert-info text-center">Kamu belum mengerjakan tugas apapun.</div>
        @endforelse
    </div>

    <!-- ✅ Bootstrap 5 CDN JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Qrj7CQOqAqYHTA8M41YF5NoN0V+a2PvD51Kh+nToR5KtnR9iHGP59VvM8XycH4FZ" crossorigin="anonymous"></script>
</body>
</html>
