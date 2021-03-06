<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Forum;
use UniSharp\LaravelFileManager\Lfm;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/forum', Forum\Index::class)->name('forum');
});

Route::group(
    ['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']],
    function () {
        Lfm::routes();
    }
);
