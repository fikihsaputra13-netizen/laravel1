<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Anggota</title>
    <style>
        body {font-family: system-ui, sans-serif; background: #f8fafc; color: #0f172a; margin: 0; padding: 0;}
        .page {min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 24px;}
        .card {width: 100%; max-width: 480px; background: white; border-radius: 24px; padding: 32px; box-shadow: 0 24px 60px rgba(15, 23, 42, 0.1);}
        h1 {margin: 0 0 20px; font-size: 28px;}
        label {display: block; margin-bottom: 10px; font-weight: 700; color: #334155;}
        input {width: 100%; padding: 14px 16px; margin-bottom: 18px; border: 1px solid #cbd5e1; border-radius: 14px; font-size: 15px;}
        button {display: inline-flex; align-items: center; justify-content: center; padding: 14px 18px; border: none; border-radius: 14px; background: #2563eb; color: white; font-weight: 700; cursor: pointer; width: 100%; margin-bottom: 12px;}
        .back-link {color: #2563eb; text-decoration: none; font-weight: 700; display: block; text-align: center;}
        .message {margin-bottom: 18px; padding: 14px 16px; border-radius: 14px;}
        .message.error {background: #fee2e2; color: #b91c1c;}
    </style>
</head>
<body>
    <div class="page">
        <div class="card">
            <h1>Tambah Anggota Baru</h1>

            @if ($errors->any())
                <div class="message error">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('members.store') }}">
                @csrf

                <label for="name">Nama Lengkap</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus>

                <label for="email">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required>

                <label for="password">Password</label>
                <input id="password" name="password" type="password" required>

                <label for="password_confirmation">Konfirmasi Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required>

                <button type="submit">Tambah Anggota</button>
            </form>

            <a href="{{ route('members.index') }}" class="back-link">← Kembali ke Daftar Anggota</a>
        </div>
    </div>
</body>
</html>