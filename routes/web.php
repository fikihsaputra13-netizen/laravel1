<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [LibraryController::class, 'index'])->name('dashboard');
    Route::resource('books', BookController::class)->except(['show', 'create']);
    Route::post('/books/{book}/borrow', [LoanController::class, 'borrow'])->name('books.borrow');
    Route::post('/books/{book}/return', [LoanController::class, 'returnBook'])->name('books.return');
    Route::post('/loans/{loan}/pay-fine', [LoanController::class, 'payFine'])->name('loans.payFine');
    Route::post('/loans/{loan}/set-fine', [LoanController::class, 'setFine'])->name('loans.setFine');
    Route::resource('members', MemberController::class)->except(['show', 'edit', 'update', 'destroy']);
    
    // Chat routes
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/api/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::get('/api/chat/messages', [ChatController::class, 'getMessages'])->name('chat.messages');
});
