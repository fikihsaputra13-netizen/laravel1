<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Anggota</title>
    <style>
        body {font-family: system-ui, sans-serif; background: #f8fafc; color: #0f172a; margin: 0; padding: 0;}
        .page {min-height: 100vh; padding: 24px;}
        .card {background: white; border-radius: 24px; padding: 32px; box-shadow: 0 24px 60px rgba(15, 23, 42, 0.1); margin-bottom: 24px;}
        h1 {margin: 0 0 20px; font-size: 28px;}
        .btn {display: inline-flex; align-items: center; justify-content: center; padding: 12px 18px; border: none; border-radius: 12px; background: #2563eb; color: white; text-decoration: none; font-weight: 700; cursor: pointer; margin-bottom: 20px;}
        table {width: 100%; border-collapse: collapse; margin-top: 20px;}
        th, td {text-align: left; padding: 12px 14px; border-bottom: 1px solid #e2e8f0;}
        th {font-size: 14px; color: #475569; text-transform: uppercase; letter-spacing: .02em;}
        tr:last-child td {border-bottom: none;}
        .back-link {color: #2563eb; text-decoration: none; font-weight: 700;}
        .message {margin-bottom: 18px; padding: 14px 16px; border-radius: 14px; background: #d1fae5; color: #065f46;}
    </style>
</head>
<body>
    <div class="page">
        <div class="card">
            <h1>Daftar Anggota Perpustakaan</h1>

            @if (session('status'))
                <div class="message">{{ session('status') }}</div>
            @endif

            <a href="{{ route('members.create') }}" class="btn">Tambah Anggota Baru</a>
            <a href="{{ route('dashboard') }}" class="back-link">← Kembali ke Dashboard</a>

            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Bergabung</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($members as $member)
                        <tr>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->email }}</td>
                            <td>{{ $member->created_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>