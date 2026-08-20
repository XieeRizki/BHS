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
use App\Http\Controllers\Frontend\HighlightController;

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
use App\Http\Controllers\Admin\HighlightController as AdminHighlightController;

/*
|--------------------------------------------------------------------------
| FRONTEND (Publik) — bisa diakses siapa aja, gak perlu login
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
Route::get('/fasilitas', [FrontendFacilityController::class, 'index'])->name('facilities');
Route::get('/layanan', [FrontendLayananController::class, 'index'])->name('layanan.index');
Route::get('/testimoni', [FrontendTestimonialController::class, 'index'])->name('testimonials');
Route::get('/informasi', [InformasiController::class, 'index'])->name('informasi');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::post('/reservasi', [ReservationController::class, 'store'])->name('reservation.store');

// --- Halaman detail (pakai slug via route model binding) ---
Route::get('/layanan/{highlight}', [HighlightController::class, 'show'])->name('highlight.show');

Route::get('/blog/{blogPost}', function (BlogPost $blogPost) {
    abort_unless($blogPost->is_published, 404);
    return view('pages.blog-show', compact('blogPost'));
})->name('blog.show');

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

    // --------------------------------------------------
    // Dashboard
    // --------------------------------------------------
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

    // --------------------------------------------------
    // Reservasi
    // --------------------------------------------------
    Route::get('/reservations', [AdminReservationController::class, 'index'])->name('reservations.index');
    Route::put('/reservations/{reservation}/status', [AdminReservationController::class, 'updateStatus'])->name('reservations.update-status');
    Route::delete('/reservations/{reservation}', [AdminReservationController::class, 'destroy'])->name('reservations.destroy');

    // --------------------------------------------------
    // Hero Banner (singleton: index → edit → update/delete)
    // --------------------------------------------------
    Route::get('/hero', [HeroController::class, 'index'])->name('hero.index');
    Route::get('/hero/edit', [HeroController::class, 'edit'])->name('hero.edit');
    Route::put('/hero', [HeroController::class, 'update'])->name('hero.update');
    Route::delete('/hero', [HeroController::class, 'destroy'])->name('hero.delete');
    Route::delete('/hero/image/{id}', [HeroController::class, 'destroyImage'])->name('hero.image.destroy');

    // --------------------------------------------------
    // Lokasi & Kontak (singleton: edit → update)
    // --------------------------------------------------
    Route::get('/location', [LocationController::class, 'edit'])->name('location.edit');
    Route::put('/location', [LocationController::class, 'update'])->name('location.update');
    Route::get('/contact', [AdminContactController::class, 'edit'])->name('contact.edit');
    Route::put('/contact', [AdminContactController::class, 'update'])->name('contact.update');

    // --------------------------------------------------
    // Informasi & Berita (custom, bukan resource murni)
    // --------------------------------------------------
    Route::get('/informasi', [AdminInformasiController::class, 'index'])->name('informasi.index');
    Route::get('/informasi/create', [AdminInformasiController::class, 'create'])->name('informasi.create');
    Route::post('/informasi', [AdminInformasiController::class, 'store'])->name('informasi.store');
    Route::get('/informasi/{post}/edit', [AdminInformasiController::class, 'edit'])->name('informasi.edit');
    Route::put('/informasi/{post}', [AdminInformasiController::class, 'update'])->name('informasi.update');
    Route::delete('/informasi/{post}', [AdminInformasiController::class, 'destroy'])->name('informasi.destroy');

    // --------------------------------------------------
    // Kategori (dipakai bareng Informasi & Berita)
    // --------------------------------------------------
    Route::post('/kategori', [CategoryController::class, 'store'])->name('kategori.store');
    Route::delete('/kategori/{kategori}', [CategoryController::class, 'destroy'])->name('kategori.destroy');

    // --------------------------------------------------
    // Resource CRUD penuh, tapi tanpa 'show' (gak dipakai di admin)
    // --------------------------------------------------
    Route::resource('facility', FacilityController::class)->except(['show']);
    Route::resource('gallery', AdminGalleryController::class)->except(['show']);
    Route::resource('packages', PackageController::class)->except(['show']);
    Route::resource('testimonials', TestimonialController::class)->except(['show']);
    Route::resource('blog-posts', BlogPostController::class)->except(['show']);

    // --------------------------------------------------
    // Resource CRUD modal-based (index + modal add/edit, tanpa halaman create/edit terpisah)
    // --------------------------------------------------
    Route::resource('media-coverage', MediaCoverageController::class)->except(['show', 'create', 'edit']);
    Route::resource('faq', FaqController::class)->except(['show', 'create', 'edit']);
    Route::resource('awards', AwardController::class)->except(['show', 'create', 'edit']);

    // --------------------------------------------------
    // Highlight (Unit & Layanan: Hotel, Villa, Food & Beverage, dst)
    // --------------------------------------------------
    // Highlight model pakai getRouteKeyName() = 'slug' (dipakai di route publik /layanan/{highlight}).
    // Di admin, form ngirim ID (angka), bukan slug, jadi binding-nya dipaksa pakai 'id'
    // biar PUT/DELETE /admin/highlights/{id} nggak 404.
    Route::resource('highlights', AdminHighlightController::class)
        ->except(['show'])
        ->parameters(['highlights' => 'highlight:id']);

    Route::post('/highlights/{highlight}/gallery/{index}', [AdminHighlightController::class, 'destroyGalleryImage'])
        ->name('highlights.gallery.destroy');
});