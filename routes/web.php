<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware('guest')
    ->group(function () {
        Route::livewire('/login', 'auth.index')->name('login');
        Route::livewire('/register', 'auth.index')->name('register');
        Route::livewire('/', 'home')->name('home');
    });

Route::middleware('auth')->group(function () {
    Route::prefix('admin')
        ->name('admin.')
        ->middleware('role:admin')
        ->group(function () {
            Route::livewire('/dashboard', 'admin.dashboard')->name('dashboard');
            Route::livewire('/books', 'admin.book.index')->name('books.index');
            Route::livewire('/categories', 'admin.category.index')->name('categories.index');
            Route::livewire('/users', 'admin.user.index')->name('users.index');
            Route::livewire('/orders', 'admin.order.index')->name('orders.index');
            Route::livewire('/contacts', 'admin.contact.index')->name('contacts.index');
        });

    Route::middleware('role:user')
    ->name('user.')
    ->group(function () {
        Route::livewire('/explore', 'user.explore')->name('explore');
        Route::livewire('/cart', 'user.cart')->name('cart');
        Route::livewire('/contact', 'user.contact')->name('contact');
        Route::livewire('/orders', 'user.order')->name('orders');
    });

});