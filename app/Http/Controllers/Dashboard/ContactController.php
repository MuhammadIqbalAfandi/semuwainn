<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\StoreContactRequest;
use App\Models\Contact;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;

class ContactController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('isAdmin')) {
            abort(403);
        }

        $contact = Contact::get()->first();
        $whatsapp = $contact->whatsapp ?? '-';
        $callCenter = $contact->call_center ?? '-';
        $email = $contact->email ?? '-';
        $address = $contact->address ?? '-';
        return view('pages.dashboard.contact.create', compact('whatsapp', 'callCenter', 'email', 'address'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactRequest $request)
    {
        try {
            Contact::truncate();
            Contact::create($request->validated());

            return back()->with('success', __('messages.success.store.contact'));
        } catch (QueryException $e) {
            return back()->with('failed', __('messages.errors.destroy.all'));
        }
    }
}
