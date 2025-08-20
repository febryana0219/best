<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application</title>
</head>
<body>
    <h3>Detail Pelamar</h3>
    <p><strong>Nama:</strong> {{ $name }}</p>
    <p><strong>Email:</strong> {{ $email }}</p>
    <h3>Surat Lamaran</h3>
    <p>{!! nl2br(e($cover_letter)) !!}</p>
</body>
</html>
