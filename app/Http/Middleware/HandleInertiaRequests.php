<?php

namespace App\Http\Middleware;

use App\Models\Contact;
use App\Models\Copyright;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        $copyright = Copyright::get()->first();
        $copyright = $copyright->copyright ?? '-';

        $contact = Contact::get()->first();
        $whatsapp = $contact->whatsapp ?? '-';
        $callCenter = $contact->call_center ?? '-';
        $email = $contact->email ?? '-';
        $address = $contact->address ?? '-';

        return array_merge(parent::share($request), [
            'auth' => function () use ($request) {
                return [
                    'user' => $request->user(),
                ];
            },
            'footer' => [
                'copyright' => $copyright,
                'whatsapp' => $whatsapp,
                'callCenter' => $callCenter,
                'email' => $email,
                'address' => $address,
            ],
            'flash' => function () use ($request) {
                return [
                    'success' => $request->session()->get('success'),
                    'error' => $request->session()->get('error'),
                ];
            },
        ]);
    }
}
