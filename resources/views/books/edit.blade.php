<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Buku</title>
    <style>
        body {font-family: system-ui, sans-serif; background: #f8fafc; color: #0f172a; margin: 0; padding: 0;}
        .page {min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 24px;}
        .card {width: 100%; max-width: 520px; background: white; border-radius: 24px; padding: 32px; box-shadow: 0 24px 60px rgba(15, 23, 42, 0.1);}
        h1 {margin: 0 0 20px; font-size: 28px;}
        label {display: block; margin-bottom: 10px; font-weight: 700; color: #334155;}
        input, textarea, select {width: 100%; padding: 14px 16px; margin-bottom: 18px; border: 1px solid #cbd5e1; border-radius: 14px; font-size: 15px;}
        button {display: inline-flex; align-items: center; justify-content: center; padding: 14px 18px; border: none; border-radius: 14px; background: #2563eb; color: white; font-weight: 700; cursor: pointer;}
        .actions {display: flex; gap: 12px; flex-wrap: wrap; margin-top: 12px;}
        .link {color: #2563eb; text-decoration: none; font-weight: 700;}
        .message {margin-bottom: 18px; padding: 14px 16px; border-radius: 14px; background: #dbeafe; color: #1d4ed8;}
        .error {background: #fee2e2; color: #b91c1c;}
    </style>
</head>
<body>
    <div class="page">
        <div class="card">
            <h1>Edit Buku</h1>

            @if (session('status'))
                <div class="message">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="message error">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('books.update', $book) }}">
                @csrf
                @method('PUT')

                <label for="title">Judul</label>
                <input id="title" name="title" type="text" value="{{ old('title', $book->title) }}" required>

                <label for="author">Penulis</label>
                <input id="author" name="author" type="text" value="{{ old('author', $book->author) }}" required>

                <label for="category">Kategori</label>
                <input id="category" name="category" type="text" value="{{ old('category', $book->category) }}" required>

                <label for="year">Tahun</label>
                <input id="year" name="year" type="number" value="{{ old('year', $book->year) }}" required>

                <label for="status">Status</label>
                <select id="status" name="status" required>
                    <option value="tersedia" {{ old('status', $book->status) === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="dipinjam" {{ old('status', $book->status) === 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                    <option value="rusak" {{ old('status', $book->status) === 'rusak' ? 'selected' : '' }}>Rusak</option>
                </select>

                <label for="isbn">ISBN</label>
                <input id="isbn" name="isbn" type="text" value="{{ old('isbn', $book->isbn) }}">

                <label for="description">Deskripsi</label>
                <textarea id="description" name="description" rows="4">{{ old('description', $book->description) }}</textarea>

                <button type="submit">Perbarui Buku</button>
            </form>

            <div class="actions">
                <a href="{{ route('dashboard') }}" class="link">Kembali ke Dashboard</a>
            </div>
        </div>
    </div>
</body>
</html>
