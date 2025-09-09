Set WshShell = CreateObject("WScript.Shell")
WshShell.Run chr(34) & "C:\xampp\htdocs\laravel7\run-scheduler.bat" & Chr(34), 0
Set WshShell = Nothing
