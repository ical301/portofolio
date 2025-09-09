<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h2 class="text-center">
        Edit Kelas
    </h2>
    <div class="container mt-4">
      <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
          <form action="{{route('editkelas',$kelas->id)}}" method="POST">
            @csrf
            @method('patch')
            <div class="form-group mb-3">
              <label for="nama_kelas">Nama Kelas</label>
              <input value="{{$kelas->nama_kelas}}" type="text" id="nama_kelas" name="nama_kelas" class="form-control" required placeholder="Contoh: Kelas 10">
            </div>

            <div class="form-group mb-3">
              <label for="jurusan">Jurusan</label>
              <input value="{{$kelas->jurusan}}" type="text" id="jurusan" name="jurusan" class="form-control" required placeholder="Contoh: TKJ, TKR, IPA">
            </div>

            <div class="form-group mb-4">
              <label for="description">Deskripsi</label>
              <textarea id="description" name="description" class="form-control" rows="4" placeholder="Contoh: Teknik Komputer dan Jaringan, Kendaraan Ringan, dll">{{$kelas->description}}</textarea>
            </div>
            
            <button type="submit" class="btn btn-primary w-100">Simpan perubahan Kelas</button>
          </form>
        </div>
      </div>
    </div>
</body>
</html>