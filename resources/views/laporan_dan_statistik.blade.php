<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan dan Statistik</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        table { width: 60%; margin: auto; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>

    <h2>Laporan dan Statistik</h2>

    <table>
        <thead>
            <tr>
                <th>Keterangan</th>
                <th>Jumlah / Nilai</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Total Siswa Aktif</td>
                <td>{{ $totalSiswaAktif }}</td>
            </tr>
            <tr>
                <td>Total Materi</td>
                <td>{{ $totalMateri }}</td>
            </tr>
            <tr>
                <td>Total Tugas</td>
                <td>{{ $totalTugas }}</td>
            </tr>
            <tr>
                <td>Rata-rata Nilai</td>
                <td>{{ number_format($rataRataNilai, 2) }}</td>
            </tr>
            <tr>
                <td>Tugas Belum Dinilai</td>
                <td>{{ $belumDinilai }}</td>
            </tr>
            <tr>
                <td>Jumlah Hadir</td>
                <td>{{ $jumlahHadir }}</td>
            </tr>
            <tr>
                <td>Jumlah Izin</td>
                <td>{{ $jumlahIzin }}</td>
            </tr>
            <tr>
                <td>Jumlah Alpa</td>
                <td>{{ $jumlahAlpa }}</td>
            </tr>
        </tbody>
    </table>

</body>
</html>