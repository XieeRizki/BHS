<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Models\BlogPost;
// use App\Models\Facility;
// use App\Models\Gallery;
// use App\Models\Package;
// use App\Models\Testimonial;

class DashboardController extends Controller
{
    public function index()
    {
        // $stats = [
        //     'facilities' => Facility::count(),
        //     'packages' => Package::count(),
        //     'galleries' => Gallery::count(),
        //     'testimonials' => Testimonial::count(),
        //     'blog_posts' => BlogPost::count(),
        //     'published_posts' => BlogPost::where('is_published', true)->count(),
        // ];

        // $recentPosts = BlogPost::latest()->take(5)->get();

        // return view('admin.dashboard', compact('stats', 'recentPosts'));
        return view('admin.dashboard');
    }
}
