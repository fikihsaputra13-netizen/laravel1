<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $messages = ChatMessage::where('user_id', auth()->id())
            ->orderBy('created_at', 'asc')
            ->get();
        
        return view('chat.index', compact('messages'));
    }

    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:1000']
        ]);

        // Simpan pesan user
        ChatMessage::create([
            'user_id' => auth()->id(),
            'sender_type' => 'user',
            'message' => $validated['message']
        ]);

        // Generate response dari bot
        $botResponse = $this->generateBotResponse($validated['message']);

        // Simpan response bot
        ChatMessage::create([
            'user_id' => auth()->id(),
            'sender_type' => 'bot',
            'message' => $botResponse
        ]);

        return response()->json([
            'status' => 'success',
            'user_message' => $validated['message'],
            'bot_response' => $botResponse
        ]);
    }

    private function generateBotResponse($userMessage)
    {
        // Simple bot response logic
        $message = strtolower($userMessage);

        if (strpos($message, 'halo') !== false || strpos($message, 'hello') !== false) {
            return 'Halo! Selamat datang di perpustakaan online kami. Ada yang bisa kami bantu? 📚';
        } elseif (strpos($message, 'buku') !== false || strpos($message, 'pinjam') !== false) {
            return 'Anda bisa meminjam buku melalui menu "Buku" di dashboard. Pilih buku yang ingin dipinjam, atur tanggal pinjam dan tanggal pengembalian. 📖';
        } elseif (strpos($message, 'denda') !== false || strpos($message, 'terlambat') !== false) {
            return 'Denda dikenakan jika buku dikembalikan terlambat. Denda sebesar Rp 1.000 per hari keterlambatan. Anda bisa membayar denda melalui dashboard. 💳';
        } elseif (strpos($message, 'jam') !== false || strpos($message, 'operasional') !== false) {
            return 'Perpustakaan kami buka dari jam 08:00 - 17:00 setiap hari. Lokasi kami di Ruang Baca Utama. 🏛️';
        } elseif (strpos($message, 'bantuan') !== false || strpos($message, 'help') !== false) {
            return 'Kami siap membantu! Tanyakan tentang:\n• Peminjaman buku\n• Pengembalian buku\n• Denda keterlambatan\n• Jam operasional\n• Atau yang lainnya 😊';
        } else {
            return 'Terima kasih atas pertanyaan Anda. Silakan tanyakan tentang perpustakaan kami atau layanan yang tersedia. 🤖';
        }
    }

    public function getMessages()
    {
        $messages = ChatMessage::where('user_id', auth()->id())
            ->orderBy('created_at', 'asc')
            ->get();
        
        return response()->json($messages);
    }
}
