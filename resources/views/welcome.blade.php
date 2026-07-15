<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Pro - Sistem Perpustakaan Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-slate-950 via-slate-900 to-slate-900 text-white min-h-screen overflow-x-hidden relative">
    <!-- Animated Background -->
    <div class="fixed top-0 left-0 w-96 h-96 bg-cyan-500/20 rounded-full blur-3xl"></div>
    <div class="fixed bottom-0 right-0 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl"></div>
    <div class="fixed top-1/2 left-1/3 w-80 h-80 bg-blue-500/15 rounded-full blur-3xl"></div>

    <!-- Navigation -->
    <nav class="relative z-50 flex items-center justify-between max-w-7xl mx-auto px-6 py-6">
        <div class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500">
            📚 Library Pro
        </div>
        <div class="flex items-center gap-4">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-6 py-2 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-500 hover:from-cyan-600 hover:to-blue-600 font-semibold transition shadow-lg shadow-cyan-500/20">
                        📊 Dashboard
                    </a>
                @else
                    <a href="{{ route('login', [], false) }}" class="px-6 py-2 rounded-lg border border-cyan-400 text-cyan-400 hover:bg-cyan-400/10 font-semibold transition">
                        🔐 Login
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register', [], false) }}" class="px-6 py-2 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-500 hover:from-cyan-600 hover:to-blue-600 font-semibold transition shadow-lg shadow-cyan-500/20">
                            ✏️ Register
                        </a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="relative z-10 max-w-7xl mx-auto px-6 py-24">
        <!-- Hero Title -->
        <div class="text-center mb-16 space-y-6">
            <h1 class="text-6xl md:text-7xl font-bold leading-tight">
                Sistem Perpustakaan
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-blue-400 to-purple-400">
                    Digital Modern
                </span>
            </h1>
            <p class="text-xl text-slate-300 max-w-2xl mx-auto">
                Kelola koleksi buku, pinjaman anggota, dan denda dengan mudah. Sistem yang intuitif, transparan, dan mendukung komunikasi dua arah melalui chatbot AI.
            </p>
            <div class="flex gap-4 justify-center pt-4 flex-wrap">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-8 py-3 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-500 hover:from-cyan-600 hover:to-blue-600 font-bold text-lg transition shadow-lg shadow-cyan-500/30 hover:shadow-lg hover:shadow-cyan-600/40">
                            Buka Dashboard →
                        </a>
                    @else
                        <a href="{{ route('register', [], false) }}" class="px-8 py-3 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-500 hover:from-cyan-600 hover:to-blue-600 font-bold text-lg transition shadow-lg shadow-cyan-500/30 hover:shadow-lg hover:shadow-cyan-600/40">
                            Mulai Sekarang →
                        </a>
                        <a href="{{ route('login', [], false) }}" class="px-8 py-3 rounded-lg border-2 border-cyan-400 text-cyan-400 hover:bg-cyan-400/10 font-bold text-lg transition">
                            Sudah Punya Akun?
                        </a>
                    @endauth
                @endif
            </div>
        </div>

        <!-- Features Grid -->
        <div class="grid md:grid-cols-3 gap-6 mb-20">
            <div class="rounded-2xl bg-white/5 backdrop-blur border border-white/10 p-8 hover:bg-white/10 transition group">
                <div class="text-5xl mb-4 group-hover:scale-110 transition">📚</div>
                <h3 class="text-2xl font-bold mb-3">Kelola Buku</h3>
                <p class="text-slate-300">Tambah, edit, dan hapus buku dengan mudah. Tracking status ketersediaan buku secara real-time.</p>
            </div>

            <div class="rounded-2xl bg-white/5 backdrop-blur border border-white/10 p-8 hover:bg-white/10 transition group">
                <div class="text-5xl mb-4 group-hover:scale-110 transition">👥</div>
                <h3 class="text-2xl font-bold mb-3">Manajemen Anggota</h3>
                <p class="text-slate-300">Daftar anggota baru, kelola profil, dan track riwayat peminjaman setiap anggota.</p>
            </div>

            <div class="rounded-2xl bg-white/5 backdrop-blur border border-white/10 p-8 hover:bg-white/10 transition group">
                <div class="text-5xl mb-4 group-hover:scale-110 transition">🤖</div>
                <h3 class="text-2xl font-bold mb-3">Chat Bot AI</h3>
                <p class="text-slate-300">Chatbot cerdas yang siap menjawab pertanyaan tentang perpustakaan 24/7.</p>
            </div>

            <div class="rounded-2xl bg-white/5 backdrop-blur border border-white/10 p-8 hover:bg-white/10 transition group">
                <div class="text-5xl mb-4 group-hover:scale-110 transition">📖</div>
                <h3 class="text-2xl font-bold mb-3">Pinjam & Kembalikan</h3>
                <p class="text-slate-300">Proses peminjaman dan pengembalian yang simpel dengan tracking tanggal jatuh tempo.</p>
            </div>

            <div class="rounded-2xl bg-white/5 backdrop-blur border border-white/10 p-8 hover:bg-white/10 transition group">
                <div class="text-5xl mb-4 group-hover:scale-110 transition">💳</div>
                <h3 class="text-2xl font-bold mb-3">Manajemen Denda</h3>
                <p class="text-slate-300">Hitung denda otomatis, catat pembayaran, dan tampilkan laporan denda dengan detail.</p>
            </div>

            <div class="rounded-2xl bg-white/5 backdrop-blur border border-white/10 p-8 hover:bg-white/10 transition group">
                <div class="text-5xl mb-4 group-hover:scale-110 transition">📊</div>
                <h3 class="text-2xl font-bold mb-3">Dashboard Lengkap</h3>
                <p class="text-slate-300">Statistik visual, laporan komprehensif, dan insights tentang aktivitas perpustakaan.</p>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="rounded-3xl bg-gradient-to-r from-cyan-500/30 to-purple-500/30 border border-white/20 p-16 text-center backdrop-blur-xl">
            <h2 class="text-4xl font-bold mb-6">Siap Menggunakan Sistem Terbaik?</h2>
            <p class="text-xl text-slate-300 mb-8 max-w-2xl mx-auto">
                Bergabunglah dengan ribuan perpustakaan yang telah mempercayai platform kami untuk manajemen koleksi buku mereka.
            </p>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="inline-block px-8 py-4 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-500 hover:from-cyan-600 hover:to-blue-600 font-bold text-lg transition shadow-lg shadow-cyan-500/30 hover:shadow-lg hover:shadow-cyan-600/40">
                        Ke Dashboard Saya →
                    </a>
                @else
                    <a href="{{ route('register', [], false) }}" class="inline-block px-8 py-4 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-500 hover:from-cyan-600 hover:to-blue-600 font-bold text-lg transition shadow-lg shadow-cyan-500/30 hover:shadow-lg hover:shadow-cyan-600/40">
                        Daftar Gratis Sekarang →
                    </a>
                @endauth
            @endif
        </div>
    </main>

    <!-- Footer -->
    <footer class="relative z-10 border-t border-white/10 mt-24 py-12 px-6">
        <div class="max-w-7xl mx-auto text-center text-slate-400">
            <p>&copy; 2026 Library Pro. Semua hak dilindungi.</p>
            <p class="mt-2 text-sm">Platform manajemen perpustakaan digital yang modern dan terpercaya.</p>
        </div>
    </footer>
</body>
</html>
