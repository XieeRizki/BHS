<?php

use Illuminate\Support\Facades\Route;
use App\Models\BlogPost;

// ================= FRONTEND =================
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\FacilityController as FrontendFacilityController;
use App\Http\Controllers\Frontend\LayananController as FrontendLayananController;
use App\Http\Controllers\Frontend\TestimonialController as FrontendTestimonialController;
use App\Http\Controllers\Frontend\InformasiController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\ReservationController;

// ================= ADMIN =================
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\InformasiController as AdminInformasiController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\MediaCoverageController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\AwardController;
use App\Http\Controllers\Admin\LayananController as AdminLayananController;
use App\Http\Controllers\Admin\StatController;

/*
|--------------------------------------------------------------------------
| FRONTEND (Publik)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
Route::get('/fasilitas', [FrontendFacilityController::class, 'index'])->name('facilities');
Route::get('/testimoni', [FrontendTestimonialController::class, 'index'])->name('testimonials');
Route::get('/informasi', [InformasiController::class, 'index'])->name('informasi');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::post('/reservasi', [ReservationController::class, 'store'])->name('reservation.store');

// --- Halaman detail Layanan (dari Highlight) ---
Route::get('/layanan/{layanan}', [FrontendLayananController::class, 'show'])->name('layanan.show');

Route::get('/blog/{blogPost}', function (BlogPost $blogPost) {
    abort_unless($blogPost->is_published, 404);
    return view('pages.blog-show', compact('blogPost'));
})->name('blog.show');

Route::get('/fasilitas/{facility}', function (\App\Models\Facility $facility) {
    return view('pages.facility-show', compact('facility'));
})->name('facility.show');


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});


/*
|--------------------------------------------------------------------------
| ADMIN (Privat)
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

    Route::get('/reservations', [AdminReservationController::class, 'index'])->name('reservations.index');
    Route::put('/reservations/{reservation}/status', [AdminReservationController::class, 'updateStatus'])->name('reservations.update-status');
    Route::delete('/reservations/{reservation}', [AdminReservationController::class, 'destroy'])->name('reservations.destroy');

    Route::get('/hero', [HeroController::class, 'index'])->name('hero.index');
    Route::get('/hero/edit', [HeroController::class, 'edit'])->name('hero.edit');
    Route::put('/hero', [HeroController::class, 'update'])->name('hero.update');
    Route::delete('/hero', [HeroController::class, 'destroy'])->name('hero.delete');
    Route::delete('/hero/image/{id}', [HeroController::class, 'destroyImage'])->name('hero.image.destroy');

    Route::get('/location', [LocationController::class, 'edit'])->name('location.edit');
    Route::put('/location', [LocationController::class, 'update'])->name('location.update');
    Route::get('/contact', [AdminContactController::class, 'edit'])->name('contact.edit');
    Route::put('/contact', [AdminContactController::class, 'update'])->name('contact.update');

    Route::get('/informasi', [AdminInformasiController::class, 'index'])->name('informasi.index');
    Route::get('/informasi/create', [AdminInformasiController::class, 'create'])->name('informasi.create');
    Route::post('/informasi', [AdminInformasiController::class, 'store'])->name('informasi.store');
    Route::get('/informasi/{post}/edit', [AdminInformasiController::class, 'edit'])->name('informasi.edit');
    Route::put('/informasi/{post}', [AdminInformasiController::class, 'update'])->name('informasi.update');
    Route::delete('/informasi/{post}', [AdminInformasiController::class, 'destroy'])->name('informasi.destroy');

    Route::post('/kategori', [CategoryController::class, 'store'])->name('kategori.store');
    Route::delete('/kategori/{kategori}', [CategoryController::class, 'destroy'])->name('kategori.destroy');

    Route::resource('facility', FacilityController::class)->except(['show']);
    Route::resource('gallery', AdminGalleryController::class)->except(['show']);
    Route::resource('packages', PackageController::class)->except(['show']);
    Route::resource('testimonials', TestimonialController::class)->except(['show']);
    Route::resource('blog-posts', BlogPostController::class)->except(['show']);

    Route::resource('media-coverage', MediaCoverageController::class)->except(['show', 'create', 'edit']);
    Route::resource('faq', FaqController::class)->except(['show', 'create', 'edit']);
    Route::resource('awards', AwardController::class)->except(['show', 'create', 'edit']);

    
    Route::resource('layanan', AdminLayananController::class)
        ->except(['show'])
        ->parameters(['layanan' => 'layanan:id']);
    Route::post('/layanan/{layanan}/kategori', [AdminLayananController::class, 'storeKategori'])->name('layanan.kategori.store');
    Route::delete('/layanan/{layanan}/kategori/{kategori}', [AdminLayananController::class, 'destroyKategori'])->name('layanan.kategori.destroy');

    Route::post('/layanan/{layanan}/gallery-photo', [AdminLayananController::class, 'storeGalleryPhoto'])->name('layanan.gallery.store');
    Route::delete('/layanan/{layanan}/gallery-photo/{gallery}', [AdminLayananController::class, 'destroyGalleryPhoto'])->name('layanan.gallery.destroy');

    Route::resource('stats', StatController::class)->except(['show', 'create', 'edit']);
});