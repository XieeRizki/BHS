<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Contact;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
{
    View::composer('*', function ($view) {
        try {
            $contact = Contact::first();
            if (!$contact) throw new \Exception('No contact data');
        } catch (\Throwable $e) {
            $contact = (object) [
                'phone' => '(022) 1234-567',
                'whatsapp' => '62895385703917',
                'email' => 'info@balonghardi.test',
                'operational_hours' => '08:00 - 20:00',
                'facebook' => null,
                'instagram' => null,
            ];
        }

        $view->with('contact', $contact);
    });
}
}
