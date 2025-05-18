<?php


use Illuminate\Support\Facades\Route;
use App\Livewire\NewsList;
use App\Livewire\NewsDetail;
use App\Livewire\GalleryList;
use App\Livewire\GalleryDetail;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// News routes
Route::get('/noticias', NewsList::class)->name('news.index');
Route::get('/noticias/{slug}', NewsDetail::class)->name('news.show');

// Gallery routes
Route::get('/galerias', GalleryList::class)->name('gallery.index');
Route::get('/galerias/{id}', GalleryDetail::class)->name('gallery.show');


//require __DIR__.'/auth.php';
