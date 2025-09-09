<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<h2>Reminder Deadline Tugas</h2>
<p>Judul: <strong>{{ $task->title }}</strong></p>
<p>kelas :<strong>{{$task->kelas->nama_kelas}}</strong></p>
<h1>haiiiii</h1>
<p>Deadline: {{ \Carbon\Carbon::parse($task->deadline)->format('d M Y H:i') }}</p>
<p>Jangan sampai telat ya!</p>

</body>
</html>