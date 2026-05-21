<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return redirect()->route('dashboard');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'year' => ['required', 'digits:4', 'integer'],
            'status' => ['required', 'in:tersedia,dipinjam,rusak'],
            'isbn' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        Book::create($data);

        return redirect()->route('dashboard')->with('status', 'Buku berhasil ditambahkan.');
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'year' => ['required', 'digits:4', 'integer'],
            'status' => ['required', 'in:tersedia,dipinjam,rusak'],
            'isbn' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $book->update($data);

        return redirect()->route('dashboard')->with('status', 'Data buku berhasil diperbarui.');
    }

    public function destroy(Book $book)
    {
        if ($book->loans()->where('status', 'active')->exists()) {
            return redirect()->route('dashboard')->withErrors('Buku sedang dipinjam dan tidak dapat dihapus.');
        }

        $book->delete();

        return redirect()->route('dashboard')->with('status', 'Buku berhasil dihapus.');
    }
}
