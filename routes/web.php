<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Frontend\GalleryController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\FacilityController as FrontendFacilityController;
use App\Http\Controllers\Frontend\AboutController as FrontendAboutController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PricingController as FrontendPricingController;
use App\Http\Controllers\Frontend\TestimonialController as FrontendTestimonialController;
use App\Http\Controllers\Frontend\ReservationController;
use App\Models\BlogPost;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| FRONTEND (Publik) — bisa diakses siapa aja, gak perlu login
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery');

Route::post('/reservasi', [ReservationController::class, 'store'])
    ->name('reservation.store');

// Blog: halaman daftar SEMUA artikel
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/tentang', [FrontendAboutController::class, 'index'])->name('about');
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
Route::get('/fasilitas', [FrontendFacilityController::class, 'index'])->name('facilities');
Route::get('/harga', [FrontendPricingController::class, 'index'])->name('pricing');
Route::get('/testimoni', [FrontendTestimonialController::class, 'index'])->name('testimonials');

// Informasi & Berita
// TODO backend: ganti closure ini dengan controller (mis. Frontend\InformasiController@index)
// begitu data berita/spotlight/kategori udah siap disambungkan ke database
Route::get('/informasi', function () {
    return view('pages.informasi');
})->name('informasi');


// Blog detail pakai slug (BlogPost model punya getRouteKeyName() = 'slug')
Route::get('/blog/{blogPost}', function (BlogPost $blogPost) {
    abort_unless($blogPost->is_published, 404);
    return view('pages.blog-show', compact('blogPost'));
})->name('blog.show');

// Fasilitas detail
Route::get('/fasilitas/{facility}', function (\App\Models\Facility $facility) {
    return view('pages.facility-show', compact('facility'));
})->name('facility.show');


/*
|--------------------------------------------------------------------------
| AUTH — halaman login admin, URL sengaja "tersembunyi" di bawah /admin
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});


/*
|--------------------------------------------------------------------------
| ADMIN (Privat) — wajib login, prefix /admin, semua route diawali admin.*
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/stats', function () {
        return response()->json([
            'facilities' => \App\Models\Facility::count(),
            'packages' => \App\Models\Package::count(),
            'blog_posts' => \App\Models\BlogPost::count(),
            'testimonials' => \App\Models\Testimonial::count(),
            'galleries' => \App\Models\Gallery::count(),
        ]);
    })->name('dashboard.stats');


    Route::get('/reservations', [AdminReservationController::class, 'index'])
    ->name('reservations.index');
    Route::put('/reservations/{reservation}/status', [AdminReservationController::class, 'updateStatus'])
    ->name('reservations.update-status');
    Route::delete('/reservations/{reservation}', [AdminReservationController::class, 'destroy'])
    ->name('reservations.destroy');

    // Singleton: cuma edit/update, gak ada index/create/destroy
    Route::get('/hero', [HeroController::class, 'index'])->name('hero.index');
    Route::get('/hero/edit', [HeroController::class, 'edit'])->name('hero.edit');
    Route::put('/hero', [HeroController::class, 'update'])->name('hero.update');
    Route::delete('/hero', [HeroController::class, 'destroy'])->name('hero.delete');

    Route::get('/location', [LocationController::class, 'edit'])->name('location.edit');
    Route::put('/location', [LocationController::class, 'update'])->name('location.update');

    Route::get('/contact', [AdminContactController::class, 'edit'])->name('contact.edit');
    Route::put('/contact', [AdminContactController::class, 'update'])->name('contact.update');

    // Resource penuh, tapi tanpa 'show' (gak dipakai di admin)
    Route::resource('about', AboutController::class)->except(['show']);
    Route::resource('facility', FacilityController::class)->except(['show']);
    Route::resource('gallery', AdminGalleryController::class)->except(['show']);
    Route::resource('packages', PackageController::class)->except(['show']);
    Route::resource('testimonials', TestimonialController::class)->except(['show']);
    Route::resource('blog-posts', BlogPostController::class)->except(['show']);
});