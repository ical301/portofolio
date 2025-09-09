<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<h2 class="text-center mb-3 mt-5 main-heading">Daftar Tugas Anda</h2>
	<p>Nama Pembuat : {{$user_name}}</p>
	<div class="table-responsive">
	    <table class="table table-bordered table-hover table-striped align-middle">
	        <thead class="table-light">
	            <tr>
	                <th>ID</th>
	                <th>Judul</th>
	                <th>Deskripsi</th>
	                <th>Deadline</th>
	            </tr>
	        </thead>
	        <tbody>
	            @forelse ($tugas as $item)
	                <tr>
	                    <td>{{ $item->id }}</td>
	                    <td>{{ $item->title }}</td>
	                    <td>{{ \Illuminate\Support\Str::limit($item->description, 50) }}</td>
	                    <td>{{ \Carbon\Carbon::parse($item->deadline)->format('d M Y H:i') }}</td>
	                    <td>{{$item->kelas->nama_kelas ?? 'Tidak ada kelas' }}{{$item->kelas->jurusan}}</td>
	                </tr>
	            @empty
	                <tr>
	                    <td colspan="4" class="text-center">Tidak ada data tugas.</td>
	                </tr>
	            @endforelse
	        </tbody>
	    </table>
	</div>
</body>
</html>