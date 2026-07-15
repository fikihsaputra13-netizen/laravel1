<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $category = $request->get('category');
        $isAdmin = auth()->user()->is_admin;

        $booksQuery = Book::query();

        if ($search) {
            $booksQuery->where('title', 'like', '%' . $search . '%')
                      ->orWhere('author', 'like', '%' . $search . '%');
        }

        if ($category) {
            $booksQuery->where('category', $category);
        }

        $books = $booksQuery->get();

        if ($isAdmin) {
            $stats = [
                'totalBooks' => Book::count(),
                'availableBooks' => Book::where('status', 'tersedia')->count(),
                'borrowedBooks' => Book::where('status', 'dipinjam')->count(),
                'members' => \App\Models\User::count(),
                'totalFines' => Loan::where('status', 'returned')->sum('fine'),
                'overdueLoans' => Loan::where('status', 'active')->where('due_date', '<', now())->count(),
            ];

            $loans = Loan::with(['user', 'book'])
                        ->where('status', 'active')
                        ->orderBy('due_date')
                        ->get();

            $unpaidFines = Loan::with(['user', 'book'])
                        ->where('status', 'returned')
                        ->where('fine', '>', 0)
                        ->orderByDesc('fine')
                        ->get();
        } else {
            $stats = [
                'totalBooks' => Book::count(),
                'availableBooks' => Book::where('status', 'tersedia')->count(),
                'borrowedBooks' => Book::where('status', 'dipinjam')->count(),
            ];

            $loans = Loan::with(['book'])
                        ->where('user_id', auth()->id())
                        ->where('status', 'active')
                        ->orderBy('due_date')
                        ->get();

            $unpaidFines = Loan::with(['book'])
                        ->where('user_id', auth()->id())
                        ->where('status', 'returned')
                        ->where('fine', '>', 0)
                        ->orderByDesc('fine')
                        ->get();
        }

        $categories = Book::distinct()->pluck('category')->toArray();

        return view('dashboard', compact('books', 'stats', 'loans', 'unpaidFines', 'categories', 'search', 'category', 'isAdmin'));
    }
}
