<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Contact;
use App\Models\Master\Client;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::with('client')->latest()->paginate(20);
        $clients = Client::where('status', 'ACTIVE')->get();
        return view('master.contact.index', compact('contacts', 'clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'contact_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'role_title' => 'nullable|string|max:100',
            'is_primary' => 'boolean',
        ]);

        $validated['is_primary'] = (bool) $request->input('is_primary', 0);

        Contact::create($validated);

        return redirect()->route('master.contact')->with('success', 'Kontak berhasil ditambahkan!');
    }

    public function update(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'contact_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'role_title' => 'nullable|string|max:100',
            'is_primary' => 'boolean',
        ]);

        $validated['is_primary'] = (bool) $request->input('is_primary', 0);

        $contact->update($validated);

        return redirect()->route('master.contact')->with('success', 'Kontak berhasil diperbarui!');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('master.contact')->with('success', 'Kontak berhasil dihapus!');
    }
}
