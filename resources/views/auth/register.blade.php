<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrasi - Perpustakaan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #020617;
            background-image: radial-gradient(circle at top right, rgba(168, 85, 247, 0.18), transparent 26%),
                              radial-gradient(circle at bottom left, rgba(14, 165, 233, 0.16), transparent 32%);
        }
    </style>
</head>
<body class="min-h-screen text-slate-100 overflow-x-hidden">
    <div class="absolute inset-0 -z-10">
        <div class="absolute right-10 top-24 h-72 w-72 rounded-full bg-violet-500/15 blur-3xl"></div>
        <div class="absolute left-0 bottom-10 h-80 w-80 rounded-full bg-sky-400/10 blur-3xl"></div>
    </div>

    <div class="container mx-auto px-4 py-12">
        <div class="grid gap-10 lg:grid-cols-[1fr_0.95fr] items-center">
            <section class="space-y-8 max-w-xl text-slate-100">
                <div class="inline-flex items-center gap-3 rounded-3xl bg-white/5 px-5 py-3 text-sm text-slate-200 border border-white/10 shadow-2xl backdrop-blur-xl">
                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-800/85 text-violet-300 text-lg">✨</span>
                    <div>
                        <p class="font-semibold">Ayo Bergabung</p>
                        <p class="text-slate-400">Buat akun untuk akses penuh ke seluruh fitur perpustakaan modern.</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <h1 class="text-5xl font-semibold tracking-tight text-white">Daftar Anggota Perpustakaan</h1>
                    <p class="text-lg leading-8 text-slate-400">Masuk ke sistem yang dibuat untuk pengelolaan buku, anggota, dan pinjaman dengan tampilan modern.</p>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-3xl bg-slate-900/80 p-6 border border-white/10 shadow-2xl">
                        <p class="text-xs uppercase tracking-[0.28em] text-cyan-300">Praktis</p>
                        <p class="mt-3 text-slate-300">Form registrasi simpel dengan validasi otomatis dan feedback yang jelas.</p>
                    </div>
                    <div class="rounded-3xl bg-slate-900/80 p-6 border border-white/10 shadow-2xl">
                        <p class="text-xs uppercase tracking-[0.28em] text-fuchsia-300">Aman</p>
                        <p class="mt-3 text-slate-300">Password terenkripsi dan sesi aman untuk setiap anggota baru.</p>
                    </div>
                </div>
            </section>

            <div class="mx-auto w-full max-w-xl rounded-[2rem] bg-slate-950/95 border border-white/10 p-8 shadow-2xl backdrop-blur-xl">
                <div class="mb-8">
                    <p class="text-sm uppercase tracking-[0.32em] text-violet-300">Daftar</p>
                    <h2 class="mt-3 text-3xl font-semibold text-white">Buat akun Anda sekarang</h2>
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

                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf
                    <label class="block text-sm font-medium text-slate-300">
                        Nama Lengkap
                        <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
                               class="mt-3 w-full rounded-3xl border border-slate-700 bg-slate-900/80 px-4 py-3 text-slate-100 outline-none transition focus:border-fuchsia-400 focus:ring-2 focus:ring-fuchsia-500/30" placeholder="Nama lengkap Anda">
                    </label>

                    <label class="block text-sm font-medium text-slate-300">
                        Email
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required
                               class="mt-3 w-full rounded-3xl border border-slate-700 bg-slate-900/80 px-4 py-3 text-slate-100 outline-none transition focus:border-fuchsia-400 focus:ring-2 focus:ring-fuchsia-500/30" placeholder="nama@domain.com">
                    </label>

                    <label class="block text-sm font-medium text-slate-300">
                        Password
                        <input id="password" name="password" type="password" required
                               class="mt-3 w-full rounded-3xl border border-slate-700 bg-slate-900/80 px-4 py-3 text-slate-100 outline-none transition focus:border-fuchsia-400 focus:ring-2 focus:ring-fuchsia-500/30" placeholder="Minimal 8 karakter">
                    </label>

                    <label class="block text-sm font-medium text-slate-300">
                        Konfirmasi Password
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                               class="mt-3 w-full rounded-3xl border border-slate-700 bg-slate-900/80 px-4 py-3 text-slate-100 outline-none transition focus:border-fuchsia-400 focus:ring-2 focus:ring-fuchsia-500/30" placeholder="Ulangi password Anda">
                    </label>

                    <button type="submit"
                            class="w-full rounded-3xl bg-gradient-to-r from-fuchsia-500 via-violet-600 to-cyan-500 px-6 py-3 text-base font-semibold text-white shadow-lg shadow-fuchsia-500/20 transition hover:scale-[1.01]">
                        🚀 Daftar Sekarang
                    </button>
                </form>

                <div class="mt-8 rounded-3xl border border-white/10 bg-slate-900/80 p-4 text-sm text-slate-400">
                    <p class="font-medium text-slate-100">Sudah punya akun?</p>
                    <p class="mt-2">Klik tombol di bawah untuk masuk kembali ke halaman login.</p>
                    <a href="{{ route('login') }}" class="mt-4 inline-flex items-center justify-center rounded-3xl bg-slate-800/80 px-5 py-3 text-sm font-semibold text-cyan-300 transition hover:bg-slate-700/90">Masuk di sini</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
