<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Perpustakaan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #020617;
            color: #e2e8f0;
            background-image: radial-gradient(circle at top left, rgba(56, 189, 248, 0.18), transparent 22%),
                              radial-gradient(circle at bottom right, rgba(168, 85, 247, 0.18), transparent 26%);
        }
    </style>
</head>
<body class="min-h-screen bg-slate-950 text-slate-100 font-sans overflow-x-hidden relative">
    <div class="container mx-auto px-4 py-8 max-w-7xl">
        <div class="absolute left-0 top-20 h-72 w-72 rounded-full bg-cyan-500/15 blur-3xl"></div>
        <div class="absolute right-0 bottom-24 h-96 w-96 rounded-full bg-violet-500/15 blur-3xl"></div>

        <!-- Header -->
        <div class="relative overflow-hidden rounded-[2rem] border border-white/10 bg-slate-900/80 p-6 mb-8 shadow-2xl backdrop-blur-xl">
            <div class="absolute -right-16 -top-16 h-52 w-52 rounded-full bg-cyan-500/10 blur-3xl"></div>
            <div class="absolute -left-16 -bottom-16 h-72 w-72 rounded-full bg-fuchsia-500/10 blur-3xl"></div>
            <div class="relative flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                <div class="max-w-3xl">
                    <p class="text-sm uppercase tracking-[0.32em] text-cyan-300">Selamat datang</p>
                    <h1 class="mt-4 text-4xl font-semibold text-white sm:text-5xl">
                        📚 Dashboard Perpustakaan
                    </h1>
                    <p class="mt-4 text-slate-300 text-lg">
                        Halo, <span class="font-semibold text-white">{{ auth()->user()->name }}</span>. Kelola buku, anggota, dan pinjaman dalam satu platform modern.
                    </p>
                </div>
                <div class="flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route('members.index') }}"
                       class="inline-flex items-center justify-center gap-2 rounded-3xl bg-gradient-to-r from-cyan-400 via-blue-500 to-violet-500 px-6 py-3 text-sm font-semibold text-slate-950 transition hover:scale-[1.01] shadow-2xl shadow-cyan-500/20">
                        👥 Anggota
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-3xl border border-white/10 bg-slate-900/90 px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-800/95 shadow-2xl shadow-slate-900/40">
                            🚪 Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        @if (session('status'))
            <div class="bg-gradient-to-r from-green-100 to-emerald-100 border border-green-200 text-green-800 px-6 py-4 rounded-xl mb-6 shadow-md">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('status') }}
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-gradient-to-r from-red-100 to-rose-100 border border-red-200 text-red-800 px-6 py-4 rounded-xl mb-6 shadow-md">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                    {{ $errors->first() }}
                </div>
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
            <div class="rounded-3xl bg-slate-900/85 border border-white/10 p-6 shadow-2xl transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center gap-4">
                    <a href="#books-table" class="flex h-14 w-14 items-center justify-center rounded-3xl bg-cyan-500/10 text-cyan-300 transition hover:bg-cyan-500/20 focus:outline-none focus:ring-2 focus:ring-cyan-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </a>
                    <div>
                        <p class="text-sm uppercase tracking-[0.24em] text-slate-400">Total Buku</p>
                        <p class="mt-2 text-3xl font-semibold text-white">{{ $stats['totalBooks'] }}</p>
                    </div>
                </div>
            </div>

            <div class="rounded-3xl bg-slate-900/85 border border-white/10 p-6 shadow-2xl transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center gap-4">
                    <div class="flex h-14 w-14 items-center justify-center rounded-3xl bg-emerald-500/10 text-emerald-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm uppercase tracking-[0.24em] text-slate-400">Tersedia</p>
                        <p class="mt-2 text-3xl font-semibold text-white">{{ $stats['availableBooks'] }}</p>
                    </div>
                </div>
            </div>

            <div class="rounded-3xl bg-slate-900/85 border border-white/10 p-6 shadow-2xl transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center gap-4">
                    <div class="flex h-14 w-14 items-center justify-center rounded-3xl bg-orange-500/10 text-orange-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm uppercase tracking-[0.24em] text-slate-400">Dipinjam</p>
                        <p class="mt-2 text-3xl font-semibold text-white">{{ $stats['borrowedBooks'] }}</p>
                    </div>
                </div>
            </div>

            <div class="rounded-3xl bg-slate-900/85 border border-white/10 p-6 shadow-2xl transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center gap-4">
                    <a href="{{ route('members.index') }}" class="flex h-14 w-14 items-center justify-center rounded-3xl bg-violet-500/10 text-violet-300 transition hover:bg-violet-500/20 focus:outline-none focus:ring-2 focus:ring-violet-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </a>
                    <div>
                        <p class="text-sm uppercase tracking-[0.24em] text-slate-400">Anggota</p>
                        <p class="mt-2 text-3xl font-semibold text-white">{{ $stats['members'] }}</p>
                    </div>
                </div>
            </div>

            <div class="rounded-3xl bg-slate-900/85 border border-white/10 p-6 shadow-2xl transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center gap-4">
                    <a href="#unpaid-fines" class="flex h-14 w-14 items-center justify-center rounded-3xl bg-rose-500/10 text-rose-300 transition hover:bg-rose-500/20 focus:outline-none focus:ring-2 focus:ring-rose-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </a>
                    <div>
                        <p class="text-sm uppercase tracking-[0.24em] text-slate-400">Total Denda</p>
                        <p class="mt-2 text-3xl font-semibold text-white">Rp {{ number_format($stats['totalFines'], 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <div class="rounded-3xl bg-slate-900/85 border border-white/10 p-6 shadow-2xl transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center gap-4">
                    <a href="#active-loans" class="flex h-14 w-14 items-center justify-center rounded-3xl bg-amber-500/10 text-amber-300 transition hover:bg-amber-500/20 focus:outline-none focus:ring-2 focus:ring-amber-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </a>
                    <div>
                        <p class="text-sm uppercase tracking-[0.24em] text-slate-400">Terlambat</p>
                        <p class="mt-2 text-3xl font-semibold text-white">{{ $stats['overdueLoans'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            <!-- Books Table -->
            <div class="xl:col-span-2">
                <div class="rounded-[2rem] bg-slate-900/70 border border-white/10 shadow-2xl p-6">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-white mb-2">📖 Daftar Buku</h2>
                            <p class="text-slate-400">Kelola koleksi buku perpustakaan dengan mudah</p>
                        </div>
                    </div>

                    <!-- Search Form -->
                    <form method="GET" action="{{ route('dashboard') }}" class="mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <input type="text" name="search" value="{{ $search }}"
                                       placeholder="Cari judul atau penulis..."
                                       class="w-full px-4 py-3 border border-white/10 bg-slate-950/80 text-slate-100 rounded-xl focus:ring-2 focus:ring-cyan-400 focus:border-cyan-400 transition-all duration-200">
                            </div>
                            <div>
                                <select name="category"
                                        class="w-full px-4 py-3 border border-white/10 bg-slate-950/80 text-slate-100 rounded-xl focus:ring-2 focus:ring-cyan-400 focus:border-cyan-400 transition-all duration-200">
                                    <option value="">Semua Kategori</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat }}" {{ $category == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <button type="submit"
                                        class="w-full px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                    🔍 Cari
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Books Table -->
                    <div id="books-table" class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                            <tr class="border-b border-slate-700">
                                <th class="text-left py-4 px-4 font-semibold text-slate-400 uppercase text-sm tracking-wider">Judul</th>
                                <th class="text-left py-4 px-4 font-semibold text-slate-400 uppercase text-sm tracking-wider">Penulis</th>
                                <th class="text-left py-4 px-4 font-semibold text-slate-400 uppercase text-sm tracking-wider">Kategori</th>
                                <th class="text-left py-4 px-4 font-semibold text-slate-400 uppercase text-sm tracking-wider">Tahun</th>
                                <th class="text-left py-4 px-4 font-semibold text-slate-400 uppercase text-sm tracking-wider">Status</th>
                                <th class="text-left py-4 px-4 font-semibold text-slate-400 uppercase text-sm tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($books as $book)
                                    <tr class="border-b border-slate-700 hover:bg-slate-900 transition-colors duration-200">
                                        <td class="py-4 px-4 font-medium text-white">{{ $book->title }}</td>
                                        <td class="py-4 px-4 text-slate-300">{{ $book->author }}</td>
                                        <td class="py-4 px-4 text-slate-300">{{ $book->category }}</td>
                                        <td class="py-4 px-4 text-slate-300">{{ $book->year }}</td>
                                        <td class="py-4 px-4">
                                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-sm font-semibold
                                                {{ $book->status === 'tersedia' ? 'bg-emerald-500/15 text-emerald-200' : 'bg-rose-500/15 text-rose-200' }}">
                                                <span class="w-2 h-2 rounded-full {{ $book->status === 'tersedia' ? 'bg-emerald-400' : 'bg-rose-400' }}"></span>
                                                {{ ucfirst($book->status) }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="flex gap-2 flex-wrap">
                                                <a href="{{ route('books.edit', $book) }}"
                                                   class="inline-flex items-center gap-1 px-3 py-1 bg-slate-950/80 text-slate-100 rounded-xl hover:bg-slate-900 transition-colors duration-200 text-sm font-medium shadow-sm">
                                                    ✏️ Edit
                                                </a>

                                                <form method="POST" action="{{ route('books.destroy', $book) }}" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="inline-flex items-center gap-1 px-3 py-1 bg-rose-500/10 text-rose-200 rounded-xl hover:bg-rose-500/20 transition-colors duration-200 text-sm font-medium shadow-sm">
                                                        🗑️ Hapus
                                                    </button>
                                                </form>

                                                @if ($book->status === 'tersedia')
                                                    <button type="button"
                                                            onclick="showBorrowForm({{ $book->id }}, '{{ $book->title }}')"
                                                            class="inline-flex items-center gap-1 px-3 py-1 bg-sky-500/10 text-sky-200 rounded-xl hover:bg-sky-500/20 transition-colors duration-200 text-sm font-medium shadow-sm">
                                                        📖 Pinjam
                                                    </button>
                                                @elseif ($book->status === 'dipinjam')
                                                    <button type="button"
                                                            onclick="showReturnForm({{ $book->id }}, '{{ $book->title }}')"
                                                            class="inline-flex items-center gap-1 px-3 py-1 bg-emerald-500/10 text-emerald-200 rounded-xl hover:bg-emerald-500/20 transition-colors duration-200 text-sm font-medium shadow-sm">
                                                        ↩️ Kembalikan
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Add Book Form -->
                <div class="rounded-[2rem] bg-slate-900/70 border border-white/10 shadow-2xl p-6">
                    <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                        ➕ Tambah Buku Baru
                    </h3>
                    <form method="POST" action="{{ route('books.store') }}" class="space-y-4">
                        @csrf
                        <div>
                            <input type="text" name="title" placeholder="Judul buku" required
                                   class="w-full px-4 py-3 border border-white/10 bg-slate-950/80 text-slate-100 rounded-xl focus:ring-2 focus:ring-cyan-400 focus:border-cyan-400 transition-all duration-200">
                        </div>
                        <div>
                            <input type="text" name="author" placeholder="Penulis" required
                                   class="w-full px-4 py-3 border border-white/10 bg-slate-950/80 text-slate-100 rounded-xl focus:ring-2 focus:ring-cyan-400 focus:border-cyan-400 transition-all duration-200">
                        </div>
                        <div>
                            <input type="text" name="category" placeholder="Kategori" required
                                   class="w-full px-4 py-3 border border-white/10 bg-slate-950/80 text-slate-100 rounded-xl focus:ring-2 focus:ring-cyan-400 focus:border-cyan-400 transition-all duration-200">
                        </div>
                        <div>
                            <input type="number" name="year" placeholder="Tahun" required
                                   class="w-full px-4 py-3 border border-white/10 bg-slate-950/80 text-slate-100 rounded-xl focus:ring-2 focus:ring-cyan-400 focus:border-cyan-400 transition-all duration-200">
                        </div>
                        <div>
                            <select name="status" required
                                    class="w-full px-4 py-3 border border-white/10 bg-slate-950/80 text-slate-100 rounded-xl focus:ring-2 focus:ring-cyan-400 focus:border-cyan-400 transition-all duration-200">
                                <option value="tersedia">Tersedia</option>
                                <option value="dipinjam">Dipinjam</option>
                                <option value="rusak">Rusak</option>
                            </select>
                        </div>
                        <div>
                            <input type="text" name="isbn" placeholder="ISBN"
                                   class="w-full px-4 py-3 border border-white/10 bg-slate-950/80 text-slate-100 rounded-xl focus:ring-2 focus:ring-cyan-400 focus:border-cyan-400 transition-all duration-200">
                        </div>
                        <div>
                            <textarea name="description" rows="3" placeholder="Deskripsi buku"
                                      class="w-full px-4 py-3 border border-white/10 bg-slate-950/80 text-slate-100 rounded-xl focus:ring-2 focus:ring-cyan-400 focus:border-cyan-400 transition-all duration-200 resize-none"></textarea>
                        </div>
                        <button type="submit"
                                class="w-full px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            💾 Simpan Buku
                        </button>
                    </form>
                </div>

                <!-- Active Loans -->
                <div id="active-loans" class="rounded-[2rem] bg-slate-900/70 border border-white/10 shadow-2xl p-6">
                    <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                        📋 Pinjaman Aktif
                    </h3>
                    <div class="space-y-3">
                        @forelse ($loans as $loan)
                            <div class="p-4 rounded-2xl bg-slate-950/80 border border-white/10">
                                <div class="font-semibold text-white mb-1">{{ $loan->book->title }}</div>
                                <div class="text-sm text-slate-300 mb-1">Dipinjam oleh: {{ $loan->user->name }}</div>
                                <div class="text-sm text-slate-300 mb-2">
                                    Jatuh tempo: {{ $loan->due_date ? $loan->due_date->format('d M Y') : 'Tidak diketahui' }}
                                </div>
                                @if ($loan->due_date && $loan->due_date->isPast())
                                    <div class="text-sm text-rose-300 font-medium mb-1">⚠️ Terlambat!</div>
                                @endif
                                @if ($loan->fine > 0)
                                    <div class="text-sm text-rose-300 font-medium">
                                        💰 Denda: Rp {{ number_format($loan->fine, 0, ',', '.') }}
                                    </div>
                                @endif
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-500">
                                <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p>Tidak ada pinjaman aktif</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Unpaid Fines -->
                <div id="unpaid-fines" class="rounded-[2rem] bg-slate-900/70 border border-white/10 shadow-2xl p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-bold text-white flex items-center gap-2">💳 Denda Belum Lunas</h3>
                        <span class="text-sm text-slate-400">Klik tombol untuk bayar</span>
                    </div>
                    <div class="space-y-3">
                        @forelse ($unpaidFines as $fineLoan)
                            <div class="p-4 rounded-2xl bg-slate-950/80 border border-white/10">
                                <div class="font-semibold text-white mb-1">{{ $fineLoan->book->title }}</div>
                                <div class="text-sm text-slate-300 mb-1">Anggota: {{ $fineLoan->user->name }}</div>
                                <div class="text-sm text-slate-300 mb-2">Denda: Rp {{ number_format($fineLoan->fine, 0, ',', '.') }}</div>
                                <form method="POST" action="{{ route('loans.payFine', $fineLoan) }}">
                                    @csrf
                                    <button type="submit" class="w-full inline-flex items-center justify-center gap-2 rounded-3xl bg-gradient-to-r from-rose-500 to-pink-500 px-4 py-3 text-sm font-semibold text-white transition hover:from-rose-600 hover:to-pink-600 shadow-lg shadow-rose-500/20">
                                        💳 Bayar Denda
                                    </button>
                                </form>
                            </div>
                        @empty
                            <div class="text-center py-8 text-slate-500">
                                <svg class="w-12 h-12 mx-auto mb-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p>Tidak ada denda yang harus dibayar saat ini.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Library Info -->
                <div class="rounded-[2rem] bg-slate-900/70 border border-white/10 shadow-2xl p-6">
                    <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                        🏛️ Informasi Perpustakaan
                    </h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center p-3 rounded-2xl bg-slate-950/80 border border-white/10">
                            <span class="text-slate-400">Jam operasional</span>
                            <span class="font-semibold text-cyan-300">08:00 - 17:00</span>
                        </div>
                        <div class="flex justify-between items-center p-3 rounded-2xl bg-slate-950/80 border border-white/10">
                            <span class="text-slate-400">Lokasi</span>
                            <span class="font-semibold text-emerald-300">Ruang Baca Utama</span>
                        </div>
                        <div class="flex justify-between items-center p-3 rounded-2xl bg-slate-950/80 border border-white/10">
                            <span class="text-slate-400">Layanan</span>
                            <span class="font-semibold text-violet-300">Pinjam & Kembalikan</span>
                        </div>
                        <div class="flex justify-between items-center p-3 rounded-2xl bg-slate-950/80 border border-white/10">
                            <span class="text-slate-400">Kategori populer</span>
                            <span class="font-semibold text-amber-300">Sastra, Sejarah, Fiksi</span>
                        </div>
                    </div>
                </div>
    </div>

    <!-- Modal Pinjam -->
    <div id="borrowModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-slate-900/95 rounded-[2rem] p-8 max-w-md w-full mx-4 shadow-2xl border border-white/10">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-3 rounded-2xl bg-blue-500/10">
                    <svg class="w-6 h-6 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-white">📖 Pinjam Buku</h3>
                    <p id="borrowBookTitle" class="text-slate-300 text-sm">Pinjam buku untuk anggota</p>
                </div>
            </div>
            <form id="borrowForm" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-slate-200 mb-2">Tanggal Pinjam</label>
                    <input type="date" name="loan_date" required
                           class="w-full px-4 py-3 border border-white/10 bg-slate-950/80 text-slate-100 rounded-xl focus:ring-2 focus:ring-cyan-400 focus:border-cyan-400 transition-all duration-200">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-200 mb-2">Tanggal Kembali</label>
                    <input type="date" name="due_date" required
                           class="w-full px-4 py-3 border border-white/10 bg-slate-950/80 text-slate-100 rounded-xl focus:ring-2 focus:ring-cyan-400 focus:border-cyan-400 transition-all duration-200">
                </div>
                <div class="flex gap-3 pt-4">
                    <button type="submit"
                            class="flex-1 px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        📖 Pinjam
                    </button>
                    <button type="button" onclick="closeBorrowModal()"
                            class="flex-1 px-6 py-3 bg-slate-800 text-slate-200 font-semibold rounded-xl hover:bg-slate-700 transition-all duration-300">
                        ❌ Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Kembalikan -->
    <div id="returnModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-slate-900/95 rounded-[2rem] p-8 max-w-md w-full mx-4 shadow-2xl border border-white/10">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-3 rounded-2xl bg-emerald-500/10">
                    <svg class="w-6 h-6 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-white">↩️ Kembalikan Buku</h3>
                    <p id="returnBookTitle" class="text-slate-300 text-sm">Kembalikan buku yang dipinjam</p>
                </div>
            </div>
            <form id="returnForm" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-slate-200 mb-2">Tanggal Kembali</label>
                    <input type="date" name="return_date" required
                           class="w-full px-4 py-3 border border-white/10 bg-slate-950/80 text-slate-100 rounded-xl focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 transition-all duration-200">
                </div>
                <div class="flex gap-3 pt-4">
                    <button type="submit"
                            class="flex-1 px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-white font-semibold rounded-xl hover:from-green-700 hover:to-emerald-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        ↩️ Kembalikan
                    </button>
                    <button type="button" onclick="closeReturnModal()"
                            class="flex-1 px-6 py-3 bg-slate-800 text-slate-200 font-semibold rounded-xl hover:bg-slate-700 transition-all duration-300">
                        ❌ Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showBorrowForm(bookId, bookTitle) {
            document.getElementById('borrowBookTitle').textContent = bookTitle;
            document.getElementById('borrowForm').action = `/books/${bookId}/borrow`;
            document.getElementById('borrowModal').classList.remove('hidden');
            document.getElementById('borrowModal').classList.add('flex');
        }

        function closeBorrowModal() {
            document.getElementById('borrowModal').classList.add('hidden');
            document.getElementById('borrowModal').classList.remove('flex');
        }

        function showReturnForm(bookId, bookTitle) {
            document.getElementById('returnBookTitle').textContent = bookTitle;
            document.getElementById('returnForm').action = `/books/${bookId}/return`;
            document.getElementById('returnModal').classList.remove('hidden');
            document.getElementById('returnModal').classList.add('flex');
        }

        function closeReturnModal() {
            document.getElementById('returnModal').classList.add('hidden');
            document.getElementById('returnModal').classList.remove('flex');
        }

        // Close modals when clicking outside
        document.getElementById('borrowModal').addEventListener('click', function(e) {
            if (e.target === this) closeBorrowModal();
        });

        document.getElementById('returnModal').addEventListener('click', function(e) {
            if (e.target === this) closeReturnModal();
        });
    </script>
</body>
</html>
