<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;

class RecoveryController extends Controller
{
    /**
     * Get the site settings (cached per request).
     */
    private function settings()
    {
        static $settings;
        return $settings ??= Settings::first();
    }

    /**
     * All service data, loaded from config/recovery-services.php.
     */
    private function getServices(): array
    {
        return config('recovery-services', []);
    }

    public function home()
    {
        return view('recovery.home', ['settings' => $this->settings()]);
    }

    public function services()
    {
        $services = $this->getServices();
        return view('recovery.services', ['services' => $services, 'settings' => $this->settings()]);
    }

    public function serviceDetail(string $slug)
    {
        $services = $this->getServices();

        if (!isset($services[$slug])) {
            abort(404);
        }

        $service = $services[$slug];
        return view('recovery.service-detail', ['service' => $service, 'settings' => $this->settings()]);
    }

    public function contact()
    {
        return view('recovery.contact', ['settings' => $this->settings()]);
    }

    public function claim()
    {
        return view('recovery.claim', ['settings' => $this->settings()]);
    }

    public function testimonials()
    {
        return view('recovery.testimonials', ['settings' => $this->settings()]);
    }

    public function about()
    {
        return view('recovery.about', ['settings' => $this->settings()]);
    }

    public function page(string $slug)
    {
        $allowed = ['privacy-policy', 'terms-conditions', 'cookie-policy', 'client-care-policy', 'complaints-procedure', 'etl'];

        if (!in_array($slug, $allowed, true)) {
            abort(404);
        }

        return view('recovery.pages.' . $slug, ['settings' => $this->settings()]);
    }

    public function category(string $slug)
    {
        $services = $this->getServices();

        $categoryMap = [
            'banks' => 'bank',
            'fraud' => 'online',
            'scams' => 'trading',
        ];

        if (!isset($categoryMap[$slug])) {
            abort(404);
        }

        $filtered = array_filter($services, fn($s) => $s['category'] === $categoryMap[$slug]);

        return view('recovery.category', [
            'services' => $filtered,
            'categoryName' => ucfirst($slug),
            'settings' => $this->settings(),
        ]);
    }

    public function submitClaim(Request $request)
    {
        $validated = $request->validate([
            'issue' => 'required|string|max:255',
            'amount' => 'required|string|max:255',
            'timeframe' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'message' => 'nullable|string|max:5000',
        ]);

        // TODO: Send email notification, save to database, etc.
        // Mail::to('refund@verfins.com')->send(new ClaimSubmitted($validated));

        return back()->with('success', 'Thank you! We will contact you shortly to discuss your case.');
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'service' => 'nullable|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        // TODO: Send email notification
        // Mail::to('refund@verfins.com')->send(new ContactSubmitted($validated));

        return back()->with('success', 'Thank you for your message. We will be in touch shortly.');
    }
}
