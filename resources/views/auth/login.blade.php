<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Perpustakaan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #020617;
            background-image: radial-gradient(circle at top left, rgba(99, 102, 241, 0.2), transparent 30%),
                              radial-gradient(circle at bottom right, rgba(139, 92, 246, 0.18), transparent 25%),
                              radial-gradient(circle at 60% 20%, rgba(56, 189, 248, 0.12), transparent 18%);
        }
    </style>
</head>
<body class="min-h-screen text-slate-100 overflow-x-hidden">
    <div class="absolute inset-0 -z-10">
        <div class="absolute left-1/2 top-10 h-72 w-72 -translate-x-1/2 rounded-full bg-cyan-500/20 blur-3xl"></div>
        <div class="absolute -left-20 top-1/2 h-96 w-96 rounded-full bg-violet-500/10 blur-3xl"></div>
    </div>

    <div class="container mx-auto px-4 py-12">
        <div class="grid gap-10 lg:grid-cols-[1.05fr_0.95fr] items-center">
            <section class="space-y-8 max-w-xl">
                <div class="inline-flex items-center gap-3 rounded-3xl bg-white/5 px-5 py-3 text-sm text-slate-200 shadow-[0_20px_50px_-30px_rgba(56,189,248,0.9)] border border-white/10 backdrop-blur-xl">
                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-800/90 text-cyan-300 text-lg">📚</span>
                    <div>
                        <p class="font-semibold">Sistem Perpustakaan Modern</p>
                        <p class="text-slate-400">Login untuk mengelola buku, peminjaman, dan anggota dengan lebih cepat.</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <h1 class="text-5xl font-semibold tracking-tight text-white">Masuk ke akun perpustakaan</h1>
                    <p class="text-lg leading-8 text-slate-400">Nikmati tampilan modern dan pengalaman dashboard yang bersih, responsif, dan profesional.</p>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-3xl bg-slate-900/70 p-6 border border-white/10 shadow-2xl">
                        <p class="text-sm uppercase tracking-[0.24em] text-cyan-300">Akses Cepat</p>
                        <p class="mt-3 text-slate-300">Masuk ke dashboard, kelola buku, dan pantau statistik perpustakaan dalam satu tempat.</p>
                    </div>
                    <div class="rounded-3xl bg-slate-900/70 p-6 border border-white/10 shadow-2xl">
                        <p class="text-sm uppercase tracking-[0.24em] text-fuchsia-300">User Friendly</p>
                        <p class="mt-3 text-slate-300">Desain antarmuka yang lebih segar, modern, dan mudah digunakan oleh semua anggota.</p>
                    </div>
                </div>
            </section>

            <div class="mx-auto w-full max-w-xl rounded-[2rem] bg-slate-950/95 border border-white/10 p-8 shadow-2xl backdrop-blur-xl">
                <div class="mb-8">
                    <p class="text-sm uppercase tracking-[0.32em] text-cyan-300">Masuk</p>
                    <h2 class="mt-3 text-3xl font-semibold text-white">Login ke akun Anda</h2>
                </div>

                @if (session('status'))
                    <div class="mb-6 rounded-3xl border border-emerald-400/20 bg-emerald-500/10 p-4 text-sm text-emerald-200">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 rounded-3xl border border-rose-400/20 bg-rose-500/10 p-4 text-sm text-rose-200">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login', [], false) }}" class="space-y-6">
                    @csrf
                    <label class="block text-sm font-medium text-slate-300">
                        Email
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                               class="mt-3 w-full rounded-3xl border border-slate-700 bg-slate-900/80 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-500/30" placeholder="nama@domain.com">
                    </label>

                    <label class="block text-sm font-medium text-slate-300">
                        Password
                        <input id="password" name="password" type="password" required
                               class="mt-3 w-full rounded-3xl border border-slate-700 bg-slate-900/80 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-500/30" placeholder="Kata sandi Anda">
                    </label>

                    <div class="flex items-center justify-between gap-4 text-sm sm:text-base">
                        <label class="inline-flex items-center gap-2 text-slate-300">
                            <input id="remember" name="remember" type="checkbox"
                                   class="h-4 w-4 rounded border-slate-600 bg-slate-900 text-cyan-400 focus:ring-cyan-400">
                            Ingat saya
                        </label>
                        <a href="{{ url('/') }}" class="text-cyan-300 transition hover:text-cyan-200">Kembali ke beranda</a>
                    </div>

                    <button type="submit"
                            class="w-full rounded-3xl bg-gradient-to-r from-cyan-400 via-blue-500 to-violet-500 px-6 py-3 text-base font-semibold text-slate-950 shadow-lg shadow-cyan-500/20 transition hover:scale-[1.01]">
                        🚀 Masuk sekarang
                    </button>
                </form>

            </div>
        </div>
    </div>
</body>
</html>
