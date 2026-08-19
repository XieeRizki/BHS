<?php

use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\FacilityController as FrontendFacilityController;
use App\Http\Controllers\Frontend\LayananController as FrontendLayananController;
use App\Http\Controllers\Frontend\TestimonialController as FrontendTestimonialController;
use App\Models\BlogPost;
//bagian baru
use App\Http\Controllers\Frontend\InformasiController;
use App\Http\Controllers\Admin\InformasiController as AdminInformasiController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MediaCoverageController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Frontend\ReservationController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Admin\AwardController;
use App\Http\Controllers\Admin\HighlightController as AdminHighlightController;
use App\Http\Controllers\Frontend\HighlightController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| FRONTEND (Publik) — bisa diakses siapa aja, gak perlu login
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/reservasi', [ReservationController::class, 'store'])->name('reservation.store');

// Blog: halaman daftar SEMUA artikel
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');

// Profile (gabungan Tentang BHS, Infografis, Penghargaan, Liputan Media, FAQ)
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
Route::get('/fasilitas', [FrontendFacilityController::class, 'index'])->name('facilities');
Route::get('/layanan', [FrontendLayananController::class, 'index'])->name('layanan.index');
Route::get('/testimoni', [FrontendTestimonialController::class, 'index'])->name('testimonials');

// Informasi & Berita
Route::get('/informasi', [InformasiController::class, 'index'])->name('informasi');


// Ini pakai slug (implicit binding via getRouteKeyName() di model Highlight)
Route::get('/tentang/{highlight}', [HighlightController::class, 'show'])->name('highlight.show');


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


    Route::get('/reservations', [AdminReservationController::class, 'index'])->name('reservations.index');
    Route::put('/reservations/{reservation}/status', [AdminReservationController::class, 'updateStatus'])->name('reservations.update-status');
    Route::delete('/reservations/{reservation}', [AdminReservationController::class, 'destroy'])->name('reservations.destroy');


    // Singleton: index (preview) -> edit (form) -> update / delete
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

    // Resource penuh, tapi tanpa 'show' (gak dipakai di admin)
    Route::resource('facility', FacilityController::class)->except(['show']);
    Route::resource('gallery', AdminGalleryController::class)->except(['show']);
    Route::resource('packages', PackageController::class)->except(['show']);
    Route::resource('testimonials', TestimonialController::class)->except(['show']);
    Route::resource('blog-posts', BlogPostController::class)->except(['show']);
    Route::resource('media-coverage', MediaCoverageController::class)->except(['show', 'create', 'edit']);
    Route::resource('faq', FaqController::class)->except(['show', 'create', 'edit']);
    Route::resource('awards', AwardController::class)->except(['show', 'create', 'edit']);

    // PENTING: Highlight model pakai getRouteKeyName() = 'slug' (dipakai di route publik /tentang/{highlight}).
    // Di admin, JS ngirim ID (angka), bukan slug, jadi binding-nya kita paksa pakai 'id'
    // biar PUT /admin/highlights/{id} & DELETE /admin/highlights/{id} nggak 404.
    Route::resource('highlights', AdminHighlightController::class)
        ->except(['show', 'create', 'edit'])
        ->parameters(['highlights' => 'highlight:id']);
});