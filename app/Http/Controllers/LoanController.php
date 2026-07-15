<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LoanController extends Controller
{
    public function borrow(Request $request, Book $book)
    {
        if ($book->status !== 'tersedia') {
            return redirect()->route('dashboard')->withErrors('Buku tidak tersedia untuk dipinjam.');
        }

        $data = $request->validate([
            'loan_date' => ['required', 'date'],
            'due_date' => ['required', 'date', 'after:loan_date'],
        ]);

        Loan::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'loan_date' => $data['loan_date'],
            'due_date' => $data['due_date'],
            'status' => 'active',
            'fine' => 0,
        ]);

        $book->update(['status' => 'dipinjam']);

        return redirect()->route('dashboard')->with('status', 'Buku berhasil dipinjam.');
    }

    public function returnBook(Request $request, Book $book)
    {
        abort_unless(auth()->user()->is_admin, 403);

        $data = $request->validate([
            'return_date' => ['required', 'date'],
        ]);

        $loan = Loan::where('book_id', $book->id)
            ->where('status', 'active')
            ->latest()
            ->first();

        if (! $loan) {
            return redirect()->route('dashboard')->withErrors('Tidak ada pinjaman aktif untuk buku ini.');
        }

        $returnDate = Carbon::parse($data['return_date']);
        $dueDate = Carbon::parse($loan->due_date);
        $fine = 0;

        if ($returnDate->greaterThan($dueDate)) {
            $daysLate = $returnDate->diffInDays($dueDate);
            $fine = $daysLate * 1000; // Rp 1000 per hari keterlambatan
        }

        $loan->update([
            'status' => 'returned',
            'return_date' => $data['return_date'],
            'fine' => $fine,
        ]);

        $book->update(['status' => 'tersedia']);

        $message = $fine > 0 ? "Buku berhasil dikembalikan. Denda: Rp " . number_format($fine, 0, ',', '.') : "Buku berhasil dikembalikan.";

        return redirect()->route('dashboard')->with('status', $message);
    }

    public function payFine(Loan $loan)
    {
        abort_unless(auth()->user()->is_admin, 403);

        if ($loan->status !== 'returned' || $loan->fine <= 0) {
            return redirect()->route('dashboard')->withErrors('Denda tidak tersedia untuk dilunasi.');
        }

        $loan->update(['fine' => 0]);

        return redirect()->route('dashboard')->with('status', 'Denda berhasil dilunasi.');
    }

    // Fitur baru: setFine
    public function setFine(Request $request, Loan $loan)
    {
        abort_unless(auth()->user()->is_admin, 403);
        $request->validate([
            'fine' => ['required', 'numeric', 'min:0']
        ]);

        // Hanya admin atau pemilik loan yang boleh update
        $this->authorize('update', $loan);
        $loan->update(['fine' => $request->fine]);
        return redirect()->route('dashboard')->with('status', 'Denda berhasil diubah.');
    }
}
