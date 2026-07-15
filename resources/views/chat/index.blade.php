<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Bot - Perpustakaan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .chat-message {
            animation: slideIn 0.3s ease-in-out;
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .chat-container::-webkit-scrollbar {
            width: 6px;
        }

        .chat-container::-webkit-scrollbar-track {
            background: transparent;
        }

        .chat-container::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }

        .chat-container::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.4);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500">
                    💬 Chat Bot
                </h1>
                <p class="text-slate-400 mt-2">Tanya bot kami tentang perpustakaan</p>
            </div>
            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-slate-700 hover:bg-slate-600 transition">
                ← Kembali ke Dashboard
            </a>
        </div>

        <!-- Chat Interface -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Chat Messages Area -->
            <div class="lg:col-span-3 rounded-2xl bg-slate-900/70 border border-white/10 shadow-2xl overflow-hidden flex flex-col h-[600px]">
                <!-- Messages Container -->
                <div class="chat-container flex-1 overflow-y-auto p-6 space-y-4">
                    @forelse ($messages as $message)
                        <div class="chat-message {{ $message->sender_type === 'user' ? 'flex justify-end' : 'flex justify-start' }}">
                            <div class="{{ $message->sender_type === 'user' 
                                ? 'bg-gradient-to-r from-blue-500 to-cyan-500 rounded-2xl rounded-br-none max-w-xs' 
                                : 'bg-slate-800 border border-white/10 rounded-2xl rounded-bl-none max-w-xs' }} px-4 py-3">
                                <p class="text-sm leading-relaxed whitespace-pre-wrap">{{ $message->message }}</p>
                                <p class="text-xs {{ $message->sender_type === 'user' ? 'text-blue-100' : 'text-slate-400' }} mt-2">
                                    {{ $message->created_at->format('H:i') }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="flex items-center justify-center h-full text-center">
                            <div>
                                <p class="text-6xl mb-4">🤖</p>
                                <p class="text-slate-400 text-lg">Belum ada percakapan</p>
                                <p class="text-slate-500 text-sm mt-2">Mulai tanya bot kami tentang perpustakaan</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Input Area -->
                <div class="border-t border-white/10 p-4 bg-slate-950/50">
                    <form id="chatForm" class="flex gap-3">
                        @csrf
                        <input 
                            type="text" 
                            id="messageInput"
                            name="message" 
                            placeholder="Ketik pertanyaan Anda..." 
                            class="flex-1 rounded-xl px-4 py-3 bg-slate-800 border border-white/10 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                            autocomplete="off"
                            required
                        />
                        <button 
                            type="submit"
                            class="px-6 py-3 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-500 hover:from-cyan-600 hover:to-blue-600 font-semibold text-white transition shadow-lg shadow-cyan-500/20"
                        >
                            Kirim
                        </button>
                    </form>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="space-y-6">
                <!-- Quick Commands -->
                <div class="rounded-2xl bg-slate-900/70 border border-white/10 shadow-2xl p-6">
                    <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                        ⚡ Pertanyaan Cepat
                    </h3>
                    <div class="space-y-3">
                        <button class="quick-cmd w-full text-left px-3 py-2 rounded-lg bg-slate-800 hover:bg-slate-700 transition text-sm font-medium text-cyan-300 hover:text-cyan-200" data-message="Halo">
                            💬 Sapa Bot
                        </button>
                        <button class="quick-cmd w-full text-left px-3 py-2 rounded-lg bg-slate-800 hover:bg-slate-700 transition text-sm font-medium text-cyan-300 hover:text-cyan-200" data-message="Bagaimana cara pinjam buku?">
                            📖 Cara Pinjam Buku
                        </button>
                        <button class="quick-cmd w-full text-left px-3 py-2 rounded-lg bg-slate-800 hover:bg-slate-700 transition text-sm font-medium text-cyan-300 hover:text-cyan-200" data-message="Berapa denda keterlambatan?">
                            💳 Denda Keterlambatan
                        </button>
                        <button class="quick-cmd w-full text-left px-3 py-2 rounded-lg bg-slate-800 hover:bg-slate-700 transition text-sm font-medium text-cyan-300 hover:text-cyan-200" data-message="Jam operasional perpustakaan?">
                            🕐 Jam Operasional
                        </button>
                        <button class="quick-cmd w-full text-left px-3 py-2 rounded-lg bg-slate-800 hover:bg-slate-700 transition text-sm font-medium text-cyan-300 hover:text-cyan-200" data-message="Bantuan">
                            🆘 Bantuan
                        </button>
                    </div>
                </div>

                <!-- Info Box -->
                <div class="rounded-2xl bg-slate-900/70 border border-white/10 shadow-2xl p-6">
                    <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                        ℹ️ Informasi Bot
                    </h3>
                    <div class="space-y-3 text-sm text-slate-400">
                        <p>Bot kami siap membantu menjawab pertanyaan seputar perpustakaan digital.</p>
                        <div class="bg-slate-800/50 rounded-lg p-3 border border-white/5">
                            <p class="font-semibold text-cyan-300 mb-2">Topik yang tersedia:</p>
                            <ul class="space-y-1 text-xs">
                                <li>✓ Peminjaman Buku</li>
                                <li>✓ Pengembalian Buku</li>
                                <li>✓ Denda & Pembayaran</li>
                                <li>✓ Jam Operasional</li>
                                <li>✓ Lokasi & Kontak</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const chatForm = document.getElementById('chatForm');
        const messageInput = document.getElementById('messageInput');
        const chatContainer = document.querySelector('.chat-container');
        const quickCmdButtons = document.querySelectorAll('.quick-cmd');

        // Quick command buttons
        quickCmdButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const message = button.dataset.message;
                messageInput.value = message;
                chatForm.dispatchEvent(new Event('submit'));
            });
        });

        // Send message form
        chatForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const message = messageInput.value.trim();
            if (!message) return;

            // Clear input
            messageInput.value = '';

            try {
                const response = await fetch('{{ route("chat.send") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    },
                    body: JSON.stringify({ message })
                });

                if (response.ok) {
                    // Reload chat messages
                    location.reload();
                } else {
                    alert('Gagal mengirim pesan');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error mengirim pesan');
            }
        });

        // Auto scroll to bottom
        chatContainer.scrollTop = chatContainer.scrollHeight;
    </script>
</body>
</html>
