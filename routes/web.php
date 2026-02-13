<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
Route::get('/user', [UserController::class, 'index']);
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
Route::get('foo', function () {
    return 'Hello World';
});

Route::get('user/{id}', function ($id) {
    return 'User ' . $id;
});

Route::get('posts/{post}/comments/{comment}', function ($postId, $commentId) {
    return 'Post ke: ' . $postId . ', dengan Komentar ke: ' . $commentId;
});


Route::get('/halo', function () { //get
    return "Ini route GET";
});

Route::post('/kirim', function () { //post
    return "Data berhasil dikirim dengan POST";
});
Route::get('/form', function () {
    return '
        <form method="POST" action="/kirim">
            '.csrf_field().'
            <button type="submit">Kirim</button>
        </form>
    ';
});

Route::put('/update', function () { //route put
    return "Data berhasil diupdate";
});

Route::get('/form-update', function () {
    return '
        <form method="POST" action="/update">
            '.csrf_field().'
            <input type="hidden" name="_method" value="PUT">
            <button type="submit">Update</button>
        </form>
    ';
});

Route::delete('/hapus', function () { //route delete
    return "Data berhasil dihapus";
});
Route::get('/form-hapus', function () {
    return '
        <form method="POST" action="/hapus">
            '.csrf_field().'
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit">Hapus Data</button>
        </form>
    ';
});

Route::patch('/edit', function () { //route patch
    return "Data berhasil diedit";
});
Route::get('/form-edit', function () {
    return '
        <form method="POST" action="/edit">
            '.csrf_field().'
            <input type="hidden" name="_method" value="PATCH">
            <button type="submit">Edit Data</button>
        </form>
    ';
});

// Route OPTIONS
Route::options('/cek-method', function () {
    return "Ini adalah method OPTIONS";
});

// Form untuk mengirim OPTIONS
Route::get('/form-options', function () {
    return '
        <form method="POST" action="/cek-method">
            '.csrf_field().'
            <input type="hidden" name="_method" value="OPTIONS">
            <button type="submit">Kirim OPTIONS</button>
        </form>
    ';
});

Route::match(['get', 'post'], '/multi', function () { //route match
    return "Bisa GET dan POST";
});
Route::get('/form-multi', function () {
    return '
        <form method="POST" action="/multi">
            '.csrf_field().'
            <button type="submit">Kirim POST</button>
        </form>
    ';
});

Route::any('/semua', function () { //route any
    return "Semua method bisa akses";
});
Route::get('/form-semua', function () {
    return '
        <form method="POST" action="/semua">
            '.csrf_field().' 
            <button type="submit">Kirim</button>
        </form>
    ';
});


Route::get('/there', function () {
    return "Halaman THERE";
});

Route::redirect('/here', '/there');
Route::redirect('/lama', '/there', 301);
Route::permanentRedirect('/old', '/there');

Route::view('/welcome', 'welcome');

Route::view('/welcome2', 'welcome', [
    'name' => 'Febri'
]);
// Menampilkan view tanpa mengirim data
Route::view('/welcome', 'welcome');

// Menampilkan view sambil mengirimkan data (array)
Route::view('/welcome2', 'welcome', ['name' => 'Rheyva whiny']);

Route::get('/user/{name?}', function ($name = Rheyva) {
    return "Nama: " . $name;
});

Route::get('/user/{name}', function ($name) {
    return "Nama user: " . $name;
})->where('name', '[A-Za-z]+');
Route::get('/user/{id}', function ($id) {
    return "ID User: " . $id;
})->where('id', '[0-9]+');

Route::get('/user/{id}', function ($id) {
    return "ID: " . $id;
});

Route::get('search/{search}', function ($search) {
    return $search;
})->where('search', '.*');

//Generate URL ke Route Bernama
Route::get('/profile', function () {
    return "Halaman Profile";
})->name('profile');

//ID profile
Route::get('/user/{id}/profile', function ($id) {
    return "Profile user ID: " . $id;
})->name('profile');

//profile "yes"
Route::get('/user/{id}/profile', function ($id) {
    $photos = request('photos');
    return "ID: $id | photos: $photos";
})->name('profile');

//Memeriksa Rute Saat Ini
Route::get('/profile', function () {
    return "Ini halaman profile";
})->name('profile')->middleware('cek.profile');


//Middleware
Route::middleware(['first', 'second'])->group(function () {

    Route::get('/', function () {
        return "HALAMAN HOME (kena first middleware)";
    });

    Route::get('/second', function () {
        return "HALAMAN USER PROFILE (kena second middleware)";
    });

});

//Namespaces
use App\Http\Controllers\Admin\DashboardController;

Route::prefix('admin')
    ->as('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');
    });

    Route::domain('{account}.myapp.test')->group(function () {
    Route::get('/user/{id}', function ($account, $id) {
        return "Subdomain: $account | User ID: $id";
    });
});

Route::prefix('admin')->group(function () {

    Route::get('/users', function () {
        return "Halaman Users Admin";
    });

    Route::get('/dashboard', function () {
        return "Halaman Dashboard Admin";
    });

});

Route::name('admin.')->group(function () {

    Route::get('/admin/users', function () {
        return 'Halaman Users Admin';
    })->name('users');

});











