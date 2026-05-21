<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User default untuk login cepat:
        User::factory()->create([
            'name' => 'Fikih Saputra',
            'email' => 'fikihsaputra12@gmail.com',
            'password' => Hash::make('Saputra12*!'),
        ]);

        // Create additional users for loans
        User::factory()->create([
            'name' => 'Member Satu',
            'email' => 'member1@example.com',
        ]);

        User::factory()->create([
            'name' => 'Member Dua',
            'email' => 'member2@example.com',
        ]);

        // Seed books
        $books = [
            ['title' => 'Laskar Pelangi', 'author' => 'Andrea Hirata', 'category' => 'Sastra', 'year' => 2005, 'status' => 'tersedia', 'isbn' => '9789793062794', 'description' => 'Kisah inspiratif tentang anak-anak di Belitung.'],
            ['title' => 'Sapiens', 'author' => 'Yuval Noah Harari', 'category' => 'Sejarah', 'year' => 2011, 'status' => 'dipinjam', 'isbn' => '9780062316097', 'description' => 'Sejarah singkat umat manusia.'],
            ['title' => 'Atomic Habits', 'author' => 'James Clear', 'category' => 'Pengembangan Diri', 'year' => 2018, 'status' => 'tersedia', 'isbn' => '9780735211292', 'description' => 'Panduan membangun kebiasaan baik.'],
            ['title' => 'Bumi', 'author' => 'Tere Liye', 'category' => 'Fiksi', 'year' => 2013, 'status' => 'dipinjam', 'isbn' => '9786020310595', 'description' => 'Petualangan Raib, Ali, dan Seli.'],
            ['title' => 'Fiksi Ilmiah Indonesia', 'author' => 'Rintik Sedu', 'category' => 'Fiksi', 'year' => 2022, 'status' => 'tersedia', 'isbn' => '9786230021234', 'description' => 'Kumpulan cerita fiksi ilmiah.'],
            ['title' => 'Negeri 5 Menara', 'author' => 'Ahmad Fuadi', 'category' => 'Sastra', 'year' => 2009, 'status' => 'tersedia', 'isbn' => '9789791227050', 'description' => 'Kisah perjuangan di pesantren.'],
            ['title' => 'The Subtle Art of Not Giving a F*ck', 'author' => 'Mark Manson', 'category' => 'Pengembangan Diri', 'year' => 2016, 'status' => 'dipinjam', 'isbn' => '9780062457714', 'description' => 'Panduan hidup yang tidak biasa.'],
            ['title' => 'Pulang', 'author' => 'Leila S. Chudori', 'category' => 'Sejarah', 'year' => 2012, 'status' => 'tersedia', 'isbn' => '9786020302026', 'description' => 'Kisah eksil dan pulang.'],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }

        // Seed loans
        $loans = [
            [
                'user_id' => 2, // Member Satu
                'book_id' => 2, // Sapiens
                'loan_date' => now()->subDays(10),
                'due_date' => now()->addDays(10),
                'status' => 'active',
            ],
            [
                'user_id' => 3, // Member Dua
                'book_id' => 4, // Bumi
                'loan_date' => now()->subDays(5),
                'due_date' => now()->addDays(15),
                'status' => 'active',
            ],
            [
                'user_id' => 2, // Member Satu
                'book_id' => 7, // The Subtle Art
                'loan_date' => now()->subDays(20),
                'due_date' => now()->subDays(5),
                'return_date' => now()->subDays(3),
                'status' => 'returned',
            ],
        ];

        foreach ($loans as $loan) {
            Loan::create($loan);
        }
    }
}
